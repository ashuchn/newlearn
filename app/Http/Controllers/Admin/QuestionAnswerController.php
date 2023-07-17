<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use App\Helpers\QuizHelper;
use App\Helpers\flashHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $data = Quiz::orderBy('created_at','desc')->get();
        return view('backend.quiz.index', compact('data'));
    }

    public function addQuiz()
    {
        return view('backend.quiz.add');
    }

    public function saveQuiz(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "quiz_name"     => "required",
            "start_date"    => ['required','date_format:d/m/Y']
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withInput();
        }

        $data = QuizHelper::create($valid->validated());
        if(!$data) {
            flashHelper::errorResponse('Error while saving data!');
            return back();
        }
        flashHelper::successResponse('Saved!');
        return redirect()->route('quiz.index');
    }

    public function quizQuestions($quizId)
    { 
        $questionAnswers = Quiz::with('questions.answers')->findOrFail($quizId);
        return view('backend.quiz.questions', compact('questionAnswers'));
    }

    public function quizQuestionDelete($questionId)
    {
        $data = QuizHelper::quizQuestionDelete($questionId);

        if($data) {
            flashHelper::successResponse('Question deleted!');
            return back();
        } else {
            flashHelper::errorResponse('Some error occured!');
            return back();
        }
    }

    public function quizAddQuestions($quizId)
    {
        return view('backend.quiz.addQuestion');
    }

    public function quizSaveQuestionAnswer($quizId, Request $request)
    {
        $valid = Validator::make($request->all(),[
            "question"      => "required|max:255",
            "answer"        => "required|array|min:4",
            "correctAnswer" => "required|integer|between:1,4"
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back();
        };
        $data = QuizHelper::saveQuestionAnswer($quizId, $valid->validated());

        if(!$data){
            flashHelper::errorResponse('Some Error Occured!');
            return back();
        }
        flashHelper::successResponse('Question and answers saved successfully!');

        // Redirect or perform any desired action
        return redirect()->route('quiz.questions', ['quizId' => $quizId]);

    }

    public function changePublishStatus(Request $request)
    {
        $data = QuizHelper::changePublishStatus($request);
        return $data;     
    }

    public function viewSubmissions($quizId)
    {
        $data = QuizHelper::viewSubmissions($quizId);
        return view('backend.quiz.submissions', compact('data'));
    }

    public function quizResult(Quiz $quizId, User $userId)
    {
        $data = QuizHelper::quizResult($quizId, $userId);
        return view('backend.quiz.result', compact('data'));
    }

    public function generateReport($quizId)
    {
        $data = QuizHelper::generateReport($quizId);
        $quiz = Quiz::find($quizId)?->quiz_name;
        return view('backend.quiz.report', compact('data','quiz'));
    }

    public function calculateOverallResults()
    {
        $data = QuizHelper::calculateOverallResults();
        // return $data;
        return view('backend.quiz.overallResult', compact('data'));
    }

}
