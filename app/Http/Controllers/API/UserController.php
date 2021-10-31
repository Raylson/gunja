<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Examiner;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $allUsers = User::select('id', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'mobile', 'address', 'is_email_verified', 'is_phone_verified', 'avatar', 'provider', 'user_type')->whereIn('user_type', ['superadmin', 'admin', 'user'])->orderBy('id', 'desc')
                        ->get();
        
        return response(['all_users' => $allUsers]);
    }

    public function store (Request $request) {
    	$validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'gender' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'mobile' => 'required|string|max:20|unique:users',
	        // 'phone' => 'required|string|max:20',
	        'address' => 'required|string|max:150',
	        'password' => 'required|string|min:6|confirmed',
	        // 'role' => 'required',
	        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
        $userData['last_name'] = '';
        if ($request->hasFile('avatar')) {
            $filenameWithExt = $request->avatar->getClientOriginalName();
            $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
            $extension = $request->avatar->getClientOriginalExtension();
            $featuredImageNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->avatar->storeAs('public/user/', $featuredImageNameToStore);
            $user_avatar = 'user/' . $featuredImageNameToStore;
            $userData['avatar'] = $user_avatar;
        }

        $user = User::create($userData);

        if($user)
        {
            // Adding permissions via a role
            $user->assignRole($request->role);

            \Session::flash('quick_msg', 'User registration succecss! Please login now.');
            return response([ 'status' => 'success', 'msg' => 'User registered successfully.'], 200);
        }
        else
            return response(['message' => 'Error on creating new user. Try again.'], 422);
	}

    public function show($id)
    {
        try {
            $user = User::select('id', 'first_name', 'middle_name', 'last_name', 'gender', 'email', 'phone', 'mobile', 'address', 'avatar', 'bio', 'website', 'username', 'user_type')->whereIn('user_type', ['superadmin', 'admin', 'user'])->findOrFail($id);
            return response(['status' => 'success', 'user' => $user, 'role' => count($user->getRoleNames()) > 0 ? $user->getRoleNames()[0] : ''], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        }        
    }

    public function update(Request $request, $id) {
        try
        {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                // 'last_name' => 'required|string|max:255',
                // 'gender' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'mobile' => 'required|string|max:20|unique:users,mobile,'.$id,
                // 'phone' => 'required|string|max:20',
                'address' => 'required|string|max:150',
                'password' => 'string|min:6|confirmed',
                // 'role' => 'required',
                // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
    
            $userData = $request->all();
            unset($userData['roles']);
            unset($userData['_method']);
            unset($userData['id']);
            unset($userData['provider']);            
            $userData['last_name'] = '';
            
            if($request->password)
                $userData['password'] = Hash::make($request->password);
            else
                unset($userData['password']);
             
                
            $user = User::findOrFail($id);
            $previous_avatar = $user->avatar;

            if ($request->hasFile('avatar')) {
                $filenameWithExt = $request->avatar->getClientOriginalName();
                $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
                $extension = $request->avatar->getClientOriginalExtension();
                $featuredImageNameToStore = $filename . '_' . time() . '.' . $extension;
                $request->avatar->storeAs('public/user/', $featuredImageNameToStore);
                $user_avatar = 'user/' . $featuredImageNameToStore;
                $userData['avatar'] = $user_avatar;
            }

            if($user->update($userData))
            {
                // revoke user roles and again add role
                // $user->roles()->detach();
                // $user->assignRole($request->role);
                $user->syncRoles([$request->role]);

                if ($request->hasFile('avatar') || $userData['avatar'] == '') {
                    if($previous_avatar != '')
                    {
                        $image_path = "/public"."/".$previous_avatar;
                        \Storage::delete($image_path);
                    }
                }
            }

            return response(['status' => 'success', 'message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        }        
    }

    public function destroy($id) {
        try
        {
            $user = User::findOrFail($id);
            $temp = $user;
            if($user->delete())
            {
                if ($temp->avatar != '')
                {
                    $image_path = "/public"."/".$temp->avatar;
                    \Storage::delete($image_path);
                }
            }

            return response(['status' => 'success', 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCountDashboard()
    {
        $cat = Category::select('id')->withCount('subCategories')->get();
        $que = Question::count();
        $examiner = Examiner::where('submission_id', '!=', '')->count();
        return response([ 'status' => 'success', 'cat_count' => $cat->count(), 'subcat_count' => $cat->sum('sub_categories_count'), 'question_count' => $que, 'examiner_count' => $examiner], 200);            
    }
}
