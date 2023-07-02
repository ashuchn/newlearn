<?php

namespace App\Http\Controllers\User;

use App\Models\TapQuiz;
use App\Models\TapAnswers;
use App\Models\TapQuestion;
use App\Models\TapResponse;
use Illuminate\Http\Request;
use App\Models\TapSubmitAnswer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TapController extends Controller
{
    public function index()
    {
        return view('frontend.tap.index');
    }

    public function todayQuiz()
    {
        $data = TapQuiz::where('start_date', date('Y-m-d'))->get();
        foreach ($data as $quiz) {
            $quiz->hasUserGivenQuiz = $quiz->hasUserGivenQuiz;
        }
        return view('frontend.tap.all', compact('data'));
    }

    public function takeQuiz($quizId)
    {
        $questionAnswers = TapQuestion::where('tap_quiz_id', $quizId)->with(['answers'])->get();
        // return $questionAnswers;
        return view('frontend.tap.takeQuiz', compact('questionAnswers'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        // save user response 
        $tapResponse = TapResponse::create([
            "user_id" => auth()->user()->id,
            "tap_quiz_id" => $quizId
        ]);
        if($request->has('answer')) {
            $answer = $request->answer;
            foreach($answer as $questionId => $answerId) {
                $answerInstance = TapAnswers::find($answerId);
                TapSubmitAnswer::create([
                    "tap_response_id"   => $tapResponse->id,
                    "question_id"       => $questionId,
                    "answer_id"         => $answerId,
                    "marks"             => $answerInstance->marks
                ]);
            }

            return redirect()->route('tap.quiz.result', 
                [
                    'quizId' => $quizId,'tapResponseId' => $tapResponse->id
                ])->with('success','Result Generated');
        }
        return redirect()->route('tap.quiz.result', 
                [
                    'quizId' => $quizId,'tapResponseId' => $tapResponse->id
                ])->with('success','No answer Submitted! Result Generated');
    }

    public function quizResult($quizId, TapResponse $tapResponseId = null)
    {
        if(!isset($tapResponseId)) {
            $tapResponseId = TapResponse::where([
                ['tap_quiz_id', $quizId],
                ['user_id', auth()->user()->id]
            ])->first();
        }
        $quiz               = TapQuiz::find($quizId);
        $totalQuestions     = TapQuestion::where('tap_quiz_id', $quizId)->count();
        $submittedAnswerIds   = TapSubmitAnswer::where('tap_response_id', $tapResponseId->id)->pluck('answer_id');
        $totalMarks = TapAnswers::whereIn('id', $submittedAnswerIds)->sum('marks');
        return view('frontend.tap.show', compact('totalMarks','quiz','tapResponseId'));
    }

    public function pastSubmissions()
    {
        $data = TapResponse::where('user_id', Auth::id())->with('tapQuiz')->get();
        return view('frontend.tap.pastSubmissions', compact('data'));
    }
}
