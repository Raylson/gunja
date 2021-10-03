<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allQuestions = Question::with('subCategory:id,title')->select('id', 'question', 'category_id', 'sub_category_id', 'score')->orderBy('id', 'asc')->paginate(20);
        return response(['all_questions' => $allQuestions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'question' => 'required|string|max:255',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'score' => 'required'
            ]);

            $questionData = $request->except(['answers']);
            $question = Question::create($questionData);

            $data['answers'] = json_decode(stripslashes($request->answers), true);
            $QuestionAns = [];
            if($data['answers'])
            {
                foreach ($data['answers'] as $pk => $pv) {
                    if($pv['answer_0'] != '')
                    {
                        array_push($QuestionAns, new QuestionAnswer(
                            [
                                'question_id' => $question->id,
                                'answer_0' => $pv['answer_0'],
                                'answer_1' => $pv['answer_1'],
                                'answer_2' => $pv['answer_2'],
                                'answer_3' => $pv['answer_3'],
                                'answer_4' => $pv['answer_4'],
                                'answer_5' => $pv['answer_5']
                            ]
                        ));
                    }
                }
                $question->answers()->saveMany($QuestionAns);
            }

            return response([ 'status' => 'success', 'message' => 'Question Created Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $question = Question::select('id', 'question', 'category_id', 'sub_category_id', 'score')->findOrFail($id);
            $answers = $question->answers->map(function ($ans) {
                return ['answer_0' => $ans['answer_0'], 'answer_1' => $ans['answer_1'], 'answer_2' => $ans['answer_2'], 'answer_3' => $ans['answer_3'], 'answer_4' => $ans['answer_4'], 'answer_5' => $ans['answer_5']];
            });
            return response(['status' => 'success', 'question' => $question, 'answers' => $answers], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 500);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $validatedData = $request->validate([
                'question' => 'required|string|max:255',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'score' => 'required'
            ]);

            $questionData = $request->except(['answers']);
            $question = Question::findOrFail($id);

            $question->update($questionData);

            $data['answers'] = json_decode(stripslashes($request->answers), true);
            $QuestionAns = [];
            $question->answers()->delete();    // delete all old answers data and entry new datas
            if($data['answers'])
            {
                foreach ($data['answers'] as $pk => $pv) {
                    if($pv['answer_0'] != '')
                    {
                        array_push($QuestionAns, new QuestionAnswer(
                            [
                                'question_id' => $question->id,
                                'answer_0' => $pv['answer_0'],
                                'answer_1' => $pv['answer_1'],
                                'answer_2' => $pv['answer_2'],
                                'answer_3' => $pv['answer_3'],
                                'answer_4' => $pv['answer_4'],
                                'answer_5' => $pv['answer_5']
                            ]
                        ));
                    }
                }
                $question->answers()->saveMany($QuestionAns);
            }

            return response([ 'status' => 'success', 'message' => 'Question Updated Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $question = Question::findOrFail($id);
            $question->delete();
            return response(['status' => 'success', 'message' => 'Question deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
