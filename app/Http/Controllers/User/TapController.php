<?php

namespace App\Http\Controllers\User;


use App\Models\TapQuestion;
use App\Models\TapResponse;
use App\Models\TapSubmission;
use Illuminate\Http\Request;
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
        $morningTaps = TapQuestion::where('time_of_the_day',1)->get();
        $nightTaps = TapQuestion::where('time_of_the_day',2)->get();
        return view('frontend.tap.quiz', compact('morningTaps','nightTaps'));
    }


    public function submitQuiz(Request $request)
    {
        // save user response 
        $tapResponse = TapResponse::create([
            "user_id"       => auth()->user()->id,
            "submitted_on"  => \Carbon\Carbon::now()->format('Y-m-d') 
        ]);
        $morningTapMarks    = $request->morning_tap ?? 0;
        $nightTapMarks      = $request->night_tap ?? 0;
        $totalMarks         = $morningTapMarks + $nightTapMarks;

        $submit = TapSubmission::create([
            "tap_response_id"   => $tapResponse->id,
            "marks"             => $totalMarks
        ]);

        return redirect()->route('tap.quiz.result', 
        [
            'tapResponseId' => $tapResponse->id
        ])->with('success','Result Generated');
    }

    public function quizResult(TapResponse $tapResponseId = null)
    {
        if(!isset($tapResponseId)) {
            $tapResponseId = TapResponse::where([
                ['tap_quiz_id', $quizId],
                ['user_id', auth()->user()->id]
            ])->first();
        }
        
        $data = TapSubmission::where('tap_response_id', $tapResponseId->id)->first();
        return view('frontend.tap.show', compact('data'));
    }

    public function pastSubmissions()
    {
        $data = TapResponse::where('user_id', Auth::id())->with('submission')->get();
        return view('frontend.tap.pastSubmissions', compact('data'));
    }
}
