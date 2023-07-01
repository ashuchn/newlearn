<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Niyam;
use App\Models\UserNiyam;
use App\Helpers\niyamHelper;
use Illuminate\Http\Request;
use App\Models\UserNiyamResponse;
use App\Http\Controllers\Controller;

class niyamController extends Controller
{
    public function index()
    {
        return view('frontend.niyam.dashboard');
    }

    public function quiz()
    {
        $data = Niyam::all();
        if(count($data) == 0){
            return redirect()->route('user.niyam.index')->with('error','No niyams published yet!');
        }
        return view('frontend.niyam.quiz', compact('data'));
    }

    public function saveNiyam(Request $request)
    {
        $data = niyamHelper::saveUserResponse($request);
        if(!$data['success']) {
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Some Error Occured while submitting!');
            return back();
        } 

        flash()->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->addSuccess('Result Generated!');
        return redirect()->route('user.generateResult',['submissionId' => $data['data']->id]);
    }


    public function generateResult($submissionId)
    {
        $data = UserNiyamResponse::where('submission_id', $submissionId)->with('niyam')->get();
        $totalMarks = count($data);
        $obtainedMarks = $data->sum(function ($niyam) {
            return $niyam->answer == 1 ? 1 : 0;
        });
        
        return view('frontend.niyam.result', compact('data','totalMarks','obtainedMarks'));

    }

    public function submissions()
    {
        $data = niyamHelper::getSubmissions(Auth::id());
        return view('frontend.niyam.submissions', compact('data'));
    }
}
