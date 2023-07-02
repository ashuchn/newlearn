<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use App\Helpers\TapHelper;
use App\Models\User;
use App\Models\TapResponse;
use App\Models\TapQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TapController extends Controller
{
    public function index()
    {
        $data = TapQuestion::all();
        return view('backend.tap.index', compact('data'));
    }

    public function addTap()
    {
        return view('backend.tap.add');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "tap_text"          => "required",
            "marks"             => ['required','integer'],
            "time_of_the_day"   => 'required'
        ]);

        if($valid->fails()) {
            flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError($valid->errors()->first());
            return back()->withInput();
        }

        $data = TapHelper::create($valid->validated());
        if(!$data) {
            flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Error while saving data!');
            return back();
        }
        flash()->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->addSuccess('Saved!');
        return redirect()->route('tap.index');
    } 


    public function viewSubmissions($quizId)
    {
        $data = TapResponse::where('tap_quiz_id', $quizId)->get();
        return view('backend.tap.submissions', compact('data'));
    }

    public function quizResult($quizId,$userId)
    {
        $tapResponseId = TapResponse::where([
            ['tap_quiz_id', $quizId],
            ['user_id', $userId]
        ])->first();
        $quiz               = TapQuiz::find($quizId);
        $totalQuestions     = TapQuestion::where('tap_quiz_id', $quizId)->count();
        $submittedAnswerIds   = TapSubmitAnswer::where('tap_response_id', $tapResponseId->id)->pluck('answer_id');
        $totalMarks = TapAnswers::whereIn('id', $submittedAnswerIds)->sum('marks');
        $user = User::find($userId);
        return view('backend.tap.show', compact('totalMarks','quiz','tapResponseId','user'));
    }

    public function generateReport($quizId)
    {
        $data = DB::table('users')
        ->join('tap_response', 'users.id', '=', 'tap_response.user_id')
        ->join('tap_answer_submission', 'tap_response.id', '=', 'tap_answer_submission.tap_response_id')
        ->join('tap_quizzes', 'tap_response.tap_quiz_id', '=', 'tap_quizzes.id')
        ->join('tap_questions', 'tap_answer_submission.question_id', '=', 'tap_questions.id')
        ->join('tap_answers', 'tap_answer_submission.answer_id', '=', 'tap_answers.id')
        ->where('tap_quizzes.id', $quizId)
        ->select('users.id', 'users.name', DB::raw('SUM(tap_answer_submission.marks) as total_marks'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('total_marks')
        ->get();

        $quiz = TapQuiz::find($quizId);
        // return $data;
        return view('backend.tap.report', compact('data','quiz'));
    }

    public function calculateOverallResults()
    {
        // $results = TapResponse::join('tap_answer_submission', 'tap_response.id', '=', 'tap_answer_submission.tap_response_id')
        // ->join('tap_answers', 'tap_answer_submission.answer_id', '=', 'tap_answers.id')
        // ->groupBy('tap_response.user_id','tap_response.tap_quiz_id')
        // ->select(
        //     'tap_response.user_id',
        //     'tap_response.tap_quiz_id',
        //     DB::raw('sum(tap_answer_submission.marks) as total_marks')
        // )
        // ->get();
        // return $results;
        $data = TapResponse::join('tap_submissions','tap_submissions.tap_response_id','=','tap_responses.id')
                    ->groupBy('tap_responses.user_id')
                    ->select(
                        'tap_responses.user_id',
                        DB::raw('sum(tap_submissions.marks) as total_marks')
                    )
                    ->orderBy('total_marks','desc')
                    ->get();         
        return view('backend.tap.overallResult', compact('data'));
    }
}
