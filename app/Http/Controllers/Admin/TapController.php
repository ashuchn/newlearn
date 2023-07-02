<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use App\Models\User;
use App\Models\TapQuiz;
use App\Models\TapAnswers;
use App\Models\TapResult;
use App\Helpers\TapHelper;
use App\Models\TapQuestion;
use App\Models\TapResponse;
use Illuminate\Http\Request;
use App\Models\TapSubmitAnswer;
use App\Http\Controllers\Controller;

class TapController extends Controller
{
    public function index()
    {
        $data = TapQuiz::orderByDesc('id')->get();
        return view('backend.tap.index', compact('data'));
    }

    public function addQuiz()
    {
        return view('backend.tap.add');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "title"     => "required",
            "start_date"    => ['required','date_format:d/m/Y']
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

    public function changeQuizStatus(Request $request)
    {
        $data = TapHelper::changePublishStatus($request);
        return $data;     
    }

    public function tapQuestions($quizId)
    {
        $questionAnswers = TapQuiz::with('questions.answers')->find($quizId);
        return view('backend.tap.questions', compact('questionAnswers'));
    }

    public function addQuestions($quizId)
    {
        return view('backend.tap.addQuestion');
    }

    public function saveQuestion($quizId,Request $request)
    {
        $valid = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required|array',
            'answer.*' => 'required',
            'marks' => 'required|array',
            'marks.*' => 'required|numeric',
        ]);

        if($valid->fails()) {
            flash()
            ->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError($valid->errors()->first());
            return back()->withInput();
        };

        $question = TapQuestion::create([
            'tap_quiz_id'   => $quizId,
            'question_text' => $request->question,

        ]);

        $answers = $request->answer;
        $marks = $request->marks;

        foreach ($answers as $index => $answerText) {
            TapAnswers::create([
                'question_id' => $question->id,
                'answer_text' => $answerText,
                'marks' => $marks[$index],
            ]);
        }

        // Flash success message or perform any other desired actions
        flash()->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->addSuccess('Saved!');
        return redirect()->route('tap.quiz.questions', ['quizId'=>$quizId]);
    }

    public function deleteQuestion($questionId)
    {
        $delete = TapQuestion::find($questionId)->delete();
        if($delete) {
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Question deleted!');
            return back();
        } else {
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Some error occured!');
            return back();
        }
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
        $results = TapResponse::join('tap_answer_submission','tap_answer_submission.tap_response_id','=','tap_response.id')
                    ->groupBy('tap_response.user_id')
                    ->select(
                        'tap_response.user_id',
                        DB::raw('sum(tap_answer_submission.marks) as total_marks')
                    )
                    ->get();

    foreach ($results as $result) {
        $existingResult = TapResult::where('user_id', $result->user_id)
            ->first();

        if ($existingResult) {
            $existingResult->marks = $result->total_marks;
            $existingResult->save();
        } else {
            TapResult::create([
                'user_id' => $result->user_id,
                'marks' => $result->total_marks,
            ]);
        }
    }
    
    $data = DB::table('tap_results')
            ->join('users', 'tap_results.user_id', '=', 'users.id')
            ->select('tap_results.user_id', 'users.name', DB::raw('SUM(tap_results.marks) AS total_marks'))
            ->groupBy('tap_results.user_id', 'users.name')
            ->orderByDesc('total_marks')
            ->get();
    
        // return $toppers;
        return view('backend.tap.overallResult', compact('data'));
    }
}
