<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Niyam;
use App\Models\UserNiyam;
use App\Helpers\niyamHelper;
use App\Models\UserNiyamResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class niyamController extends Controller
{
    public function index()
    {
        $data = Niyam::all();
        return view('backend.niyam.index', compact('data'));
    }

    public function addNiyam()
    {
        return view('backend.niyam.add');
    }

    public function saveNiyam(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "niyam_name" => "required|max:255"
        ]);

        if($valid->fails()){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError($valid->errors()->first());
            return back();
        }

        $data = niyamHelper::saveNiyam($valid->validated());
        return redirect()->route('niyam.index')->with('success','Niyam Added!');
    }

    public function deleteNiyam($id)
    {
        $data = niyamHelper::deleteNiyam($id);
        if(!$data) {
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Some Error Occured!');
        }
        flash()->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-center',
        ])->addSuccess('Deleted!');
        return redirect()->route('niyam.index');
    }

    public function submissions()
    {
        $data = niyamHelper::getSubmissions();
        return view('backend.niyam.submissions', compact('data'));
    }

    public function generateResult($submissionId)
    {
        $data = UserNiyamResponse::where('submission_id', $submissionId)->with('niyam')->get();
        return view('backend.niyam.report', compact('data'));
    }

    public function generateOverallResult()
    {
        $data = niyamHelper::generateOverallResult();
        // return $data;
        return view('backend.niyam.overallReport', compact('data'));
    }
}
