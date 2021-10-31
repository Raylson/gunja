<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register (Request $request) {
    	$validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'mobile' => 'required|string|max:20|unique:users',
	        // 'phone' => 'required|string|max:20',
	        // 'address' => 'required|string|max:150',
	        'password' => 'required|string|min:6|confirmed',
        ]);

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        $user = User::create($userData);

        // $accessToken = $user->createToken('authToken')->accessToken;
        // return response([ 'user' => $user->only(['first_name', 'middle_name', 'last_name', 'email', 'phone', 'address']), 'access_token' => $accessToken], 200);
        if($user)
        {
            \Session::flash('quick_msg', 'User registration success! Please login now.');
            return response([ 'status' => 'success', 'msg' => 'User registered successfully.'], 200);
        }
        else
            return response(['message' => 'Error on creating new user. Try again.'], 422);
	}

    public function login (Request $request) {
		$loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 422);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        session(['user_login' => auth()->user()->only(['id', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'mobile', 'address', 'user_type', 'avatar', 'provider_id', 'provider', 'email_verified_at'])]);
        session(['user_api_token' => $accessToken]);

        return response(['status' => 'success', 'user' => auth()->user()->only(['id', 'first_name', 'middle_name', 'last_name', 'email', 'phone', 'mobile', 'address', 'user_type', 'avatar', 'provider_id', 'provider', 'email_verified_at']), 'access_token' => $accessToken], 200);
	}

	public function logout (Request $request) {
        $token = $request->user()->token();
	    $token->revoke();
        $userType = auth()->user()->user_type;
        session()->forget(['user_login', 'user_api_token', 'user_perms']);
        auth('web')->logout();

	    $response = ['message' => 'You have been successfully logged out!', 'logout' => true, 'user_type' => $userType]; // logout field is to be used in ForceJsonResponse middleware
	    return response($response, 200);
	}

    public function checkToken(Request $request)
    {
        $token = $request->header('Authorization');
        if(str_contains($token, 'null'))
            return response([ 'status' => 'success', 'access_token' => session('user_api_token')], 200);
        else if($token == 'Bearer '.session('user_api_token'))
            return response([ 'status' => 'success', 'access_token' => session('user_api_token')], 200);
        else
            return response(['status' => 'failed', 'message' => 'Sorry! Unauthorized'], 422);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email'
        ]);
        $dataResponse = self::callAPI('POST', '/password/email', json_encode($validator), '');
        
        $decodedData = json_decode($dataResponse);
        if(isset($decodedData->status) && $decodedData->status == 'failed')
        {
            return response($dataResponse, 422);
        }
        
        return response($dataResponse); 
    }

    public function reset(Request $request)
    {
        $validator = $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $dataResponse = self::callAPI('POST', '/password/reset', json_encode($request->all()), '');
        
        $decodedData = json_decode($dataResponse);
        if(isset($decodedData->status) && $decodedData->status == 'failed')
        {
            return response($dataResponse, 422);
        }
        
        return response($dataResponse); 
    }
}
