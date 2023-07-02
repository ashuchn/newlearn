<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\TapQuiz;
use App\Models\TapAnswers;
use App\Helpers\TapHelper;
use App\Models\TapQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TapController extends Controller
{
    public function index()
    {
        $data = TapQuiz::all();
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
}
