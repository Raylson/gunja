<?php

namespace App\Http\Controllers;
use App\Jobs\ExaminerErollEmailJob;
use App\Models\User;
use App\Models\Examiner;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Assessment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExamController extends Controller
{
    public function exam($uniqueKey)
    {
        $examiner = Examiner::select('id', 'email', 'unique_key', 'submission_id', 'submitted_date', 'updated_at')->where('unique_key', $uniqueKey)->first();
        if(!$examiner)
            abort(404);

        $categories = Category::select('id', 'title')->with('subCategories:id,title,category_id', 'subCategories.questions:id,sub_category_id,question', 'subCategories.questions.answers:id,question_id,answer_0,answer_1,answer_2,answer_3,answer_4,answer_5')->get();
        // dd($categories);
        return view('frontend.exam', compact('examiner', 'categories', 'uniqueKey'));
    }

    public function submitExam($uniqueKey, Request $request)
    {
        $validatedData = $request->validate([
            'answers' => 'required',
        ]);

        $examiner = Examiner::select('id')->where('unique_key', $uniqueKey)->first();
        if(!$examiner)
            abort(404);

        // Delete previous assessment of the Exaaminer with same unique_key
        if($examiner)
            Assessment::where('examiner_id', $examiner->id)->delete();

        foreach ($request->answers as $pk => $pv)
        {
            foreach ($pv as $pkk => $pvv)
            {
                $temp = explode('|', $pvv);
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
        $examiner->update(['name' => $request->name, 'phone' => $request->phone, 'company_name' => $request->company_name, 'company_address' => $request->company_address, 'designation' => $request->designation, 'submission_id' => $submissionId, 'submitted_date' => date('Y-m-d H:i:s')]);
        return redirect('/exam-summary/'.$uniqueKey);
    }

    public function examSummary($uniqueKey)
    {
        $examiner = Examiner::with('assessments:id,examiner_id,question_id,answer_id,answer,user_score,admin_score,review')->select('id', 'email', 'name', 'phone', 'company_name', 'company_address', 'designation', 'unique_key', 'submission_id', 'submitted_date', 'updated_at')->where('unique_key', $uniqueKey)->first();
        $categories = Category::select('id', 'title')->with('subCategories:id,title,category_id,score', 'subCategories.questions:id,sub_category_id,question,score', 'subCategories.questions.answers:id,question_id,answer_0,answer_1,answer_2,answer_3,answer_4,answer_5')->get();
        return view('frontend.exam-summary', compact('examiner', 'categories', 'uniqueKey'));
    }

    public function examinerDetail($examinerId)
    {
        $examiner = Examiner::with('assessments:id,examiner_id,question_id,answer_id,answer,user_score,admin_score,review')->select('id', 'email', 'name', 'phone', 'company_name', 'company_address', 'designation', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->findOrFail($examinerId);
        $uniqueKey = $examiner->unique_key;
        $categories = Category::select('id', 'title')->with('subCategories:id,title,category_id,score', 'subCategories.questions:id,sub_category_id,question,score', 'subCategories.questions.answers:id,question_id,answer_0,answer_1,answer_2,answer_3,answer_4,answer_5')->get();
        
        if(auth()->user()->user_type == 'admin')
            return view('frontend.exam-summary-admin', compact('examiner', 'categories', 'uniqueKey'));
        else
            return view('frontend.exam-summary-superadmin', compact('examiner', 'categories', 'uniqueKey'));
    }

    public function examStatusUpdate($examinerId, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        $examiner = Examiner::select('id', 'status')->findOrFail($examinerId);
        if(!$examiner)
            abort(404);
            
        $examiner->update(['status' => $request->status]);
        return back()->with('success', 'Assessment status has been updated.');
    }

    public function examScoreUpdate($examinerId, Request $request)
    {
        $validatedData = $request->validate([
            'scores' => 'required',
            'reviews' => 'required',
        ]);

        foreach($request->scores as $sk => $sv)
        {
            $review = $request->reviews[$sk] ? $request->reviews[$sk] : '';
            Assessment::where([['id', '=', $sk], ['examiner_id', '=', $examinerId]])->update(['admin_score' => $sv, 'review' => $review]);
        }
        return back()->with('success', 'Assessment status has been updated.');
    }

    public function exportPDFAssessment($examinerId)
    {
        $examiner = Examiner::with('assessments:id,examiner_id,question_id,answer_id,answer,user_score,admin_score,review')->select('id', 'email', 'name', 'phone', 'company_name', 'company_address', 'designation', 'unique_key', 'submission_id', 'submitted_date', 'updated_at', 'status')->findOrFail($examinerId);
        $uniqueKey = $examiner->unique_key;
        $categories = Category::select('id', 'title')->with('subCategories:id,title,category_id,score', 'subCategories.questions:id,sub_category_id,question,score', 'subCategories.questions.answers:id,question_id,answer_0,answer_1,answer_2,answer_3,answer_4,answer_5')->get();

        $pdf = \PDF::loadView('frontend.export-pdf',['examiner' => $examiner, 'uniqueKey' => $uniqueKey, 'categories' => $categories]);
        return $pdf->stream('assessment-'.date('Y-m-d-H-i-s').'.pdf', array('Attachment'=>0)); 
    }
}
