<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\ExaminerErollEmailJob;
use App\Models\User;
use App\Models\Examiner;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Assessment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExaminerController extends Controller
{
    public function checkExam()
    {
        try {
            $examiner = Examiner::select('unique_key')->where([['email', '=', auth()->user()->email], ['submission_id', '=', '']])->first();
            return response(['status' => 'success', 'message' => 'success.', 'examiner' => $examiner], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }
    public function register(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string',
                'company_name' => 'required|string|max:255',
                'company_address' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            $userData = $request->all();
            // $userData['first_name'] = $request->first_name;
            // $userData['email'] = $request->email;
            // $userData['phone'] = $request->phone;
            $userData['gender'] = 'male';
            $userData['user_type'] = 'examiner';
            $userData['avatar'] = 'user/avatar.jpg';
            $userData['password'] = Hash::make($request->password);
    
            $user = User::create($userData);
    
            if($user)
            {
                \Session::flash('quick_msg', 'Examiner registration success! Please login now.');
                return response(['status' => 'success', 'message' => 'Examiner registration success! Please login now.'], 200);
            }
            else
                return response(['status' => 'failed', 'message' => 'Error on creating new examiner. Try again.'], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage(), 'message' => $e->getMessage()], 500);
        } 
    }

    public function enroll(Request $request)
    {
        try {
            $examiner = Examiner::create([
                'email' => $request->email,
                'unique_key' => $this->generateUniqueCode(),
            ]);

            dispatch(new ExaminerErollEmailJob($examiner));

            return response(['status' => 'success', 'message' => 'You are successfull enrolled to Exam. Check your email for exam.'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }

    public function examNow($unique_key)
    {
        try {
            $examiner = Examiner::select('submission_id')->where([['unique_key', '=', $unique_key]])->first();
            if(!$examiner)
                return response()->json(['status' => 'failed', 'message' => 'Invalid link.'], 200);
            
            if($examiner->submission_id == '')
                $questions = Question::select('id', 'question')->with('answers:id,question_id,answer_0,answer_1,answer_2,answer_3,answer_4,answer_5')->get();
            else
                $questions = [];
            return response(['status' => 'success', 'message' => 'success.', 'questions' => $questions, 'submission_id' => $examiner->submission_id], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }

    public function examSubmit(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'unique_key' => 'required',
                'answers' => 'required',
            ]);

            $examiner = Examiner::select('id')->where('unique_key', $request->unique_key)->first();
            if(!$examiner)
                return response(['status' => 'failed', 'message' => 'Sorry! The link is invalid or you have already submitted the exam.'], 200);

            $data['answers'] = json_decode(stripslashes($request->answers), true);
            $assessments = [];
            if($data['answers'])
            {
                foreach ($data['answers'] as $pk => $pv)
                {
                    $temp = explode('|', $pv);
                    Assessment::create(
                        [
                            'examiner_id' => $examiner->id,
                            'question_id' => $temp[0],
                            'answer_id' => $temp[1],
                            'answer' => $temp[2],
                            'user_score' => $temp[3],
                            'admin_score' => '0',
                            'review' => '',
                            'admin_id' => '0',
                        ]
                    );
                }
            }

            $submissionId = strtotime(\Carbon\Carbon::now());
            Examiner::where('unique_key', $request->unique_key)->update(['submission_id' => $submissionId, 'submitted_date' => date('Y-m-d H:i:s')]);
            return response(['status' => 'success', 'message' => 'You have submitted exam successfully.', 'submission_id' => $submissionId], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where('submission_id', '!=', '')->orderBy('id', 'asc')->paginate(20);
        return response(['all_examiners' => $allExaminers]);
    }

    public function verified()
    {
        $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where('submission_id', '!=', '')->orderBy('id', 'asc')->paginate(20);
        // $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where('status', 'verified')->orderBy('id', 'asc')->paginate(20);
        return response(['all_examiners' => $allExaminers]);
    }

    public function search(Request $request) {
        $keyword = $request->keyword;
        
        // if($request->status == 'verified')
        //     $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where([['submission_id', 'like', '%'.$keyword.'%'],['status', '=', 'verified']])->orderBy('id', 'asc')->get();
        // else
        //     $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where('submission_id', 'like', '%'.$keyword.'%')->orderBy('id', 'asc')->get();
        
        $allExaminers = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->where('submission_id', 'like', '%'.$keyword.'%')->orderBy('id', 'asc')->get();
        
        return response(['status' => 'success', 'all_examiners' => $allExaminers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $examiner = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->findOrFail($id);
            $assessments = Assessment::with('question:id,question', 'admin:id,first_name,middle_name,last_name')->where('examiner_id', $examiner->id)->get();

            $categories = Category::select('id', 'title')->with('subCategories:id,title,category_id,score', 'subCategories.questions:id,sub_category_id,question,score')->get();
            // dd($categories->toArray());
            return response(['status' => 'success', 'examiner' => $examiner, 'assessments' => $assessments, 'categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function edit(Examiner $examiner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examiner $examiner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examiner $examiner)
    {
        //
    }

    public function generateUniqueCode($codeLength = 8)
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Examiner::where('unique_key', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;

    }
}
