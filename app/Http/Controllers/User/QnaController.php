<?php

namespace App\Http\Controllers\User;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserResponse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QnaController extends Controller
{
    public function index()
    {
        $quiz = Quiz::orderBy('created_at','desc')->get();
        return view('frontend.quiz.index', compact('quiz'));
    }

    public function todayQuiz()
    {
        $data = Quiz::where('start_date', date('Y-m-d'))->get();
        // return $data;
        foreach ($data as $quiz) {
            $quiz->hasUserGivenQuiz = $quiz->hasUserGivenQuiz;
        }
        return view('frontend.quiz.all', compact('data'));
    }

    public function takeQuiz($quizId)
    {
        $questionAnswers = Question::where('quiz_id', $quizId)->with(['answers'])->get();
        // return $questionAnswers;
        return view('frontend.quiz.takeQuiz', compact('questionAnswers'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        // save user response 
        $userResponse = UserResponse::create([
            "user_id" => auth()->user()->id,
            "quiz_id" => $quizId
        ]);
        if($request->has('answer')) {
            $answer = $request->answer;
            foreach($answer as $questionId => $answerId) {
                UserAnswer::create([
                    "user_response_id"  => $userResponse->id,
                    "question_id"       => $questionId,
                    "answer_id"          => $answerId
                ]);
            }

            return redirect()->route('quiz.result', 
                [
                    'quizId' => $quizId,'userResponseId' => $userResponse->id
                ])->with('success','Result Generated');
        }
        return redirect()->route('quiz.result', 
                [
                    'quizId' => $quizId,'userResponseId' => $userResponse->id
                ])->with('success','No answer Submitted! Result Generated');
    }

    public function quizResult($quizId , UserResponse $userResponseId = null)
    {
        if(!isset($userResponseId)) {
            $userResponseId = UserResponse::where([
                ['quiz_id', $quizId],
                ['user_id', auth()->user()->id]
            ])->first();
        }
        $quiz               = Quiz::find($quizId);
        $correctAnswers     = 0;
        $incorrectAnswers   = 0;
        $perAnswerMarks     = 5;
        $totalQuestions     = Question::where('quiz_id', $quizId)->count();

        $submittedAnswers   = UserAnswer::where('user_response_id', $userResponseId->id)->pluck('answer_id');
        // return $submittedAnswers;
        foreach($submittedAnswers as $answer) {
            $isCorrect = Answer::where('id', $answer)->where('is_correct', 1)->exists();
            if ($isCorrect) {
                $correctAnswers++;
            } else {
                $incorrectAnswers++;
            }
        }

        $totalMarks = $correctAnswers * $perAnswerMarks;
        return view('frontend.quiz.result', compact('totalMarks','totalQuestions','incorrectAnswers','correctAnswers','userResponseId','quiz'));
    }


}
