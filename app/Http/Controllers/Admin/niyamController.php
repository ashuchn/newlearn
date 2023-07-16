<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Niyam;
use App\Models\UserNiyam;
use Illuminate\Http\Request;
use App\Helpers\niyamHelper;
use App\Helpers\flashHelper;
use App\Models\UserNiyamResponse;
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
            flashHelper::errorResponse($valid->errors()->first());
            return back();
        }

        $data = niyamHelper::saveNiyam($valid->validated());
        return redirect()->route('niyam.index')->with('success','Niyam Added!');
    }

    public function deleteNiyam($id)
    {
        $data = niyamHelper::deleteNiyam($id);
        if(!$data) {
            flashHelper::errorResponse('Some Error Occured!');
            return back();
        }
        flashHelper::successResponse('Deleted!');
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

    public function editNiyam($id)
    {
        $data = niyamHelper::editNiyam($id);
        // return $data;
        return view('backend.niyam.edit',compact('data'));
    }

    public function updateNiyam($id, Request $request)
    {
        $data = niyamHelper::updateNiyam($id, $request);
        if(!$data) {
            flashHelper::errorResponse('Some Error Occured!');
        }
        flashHelper::successResponse('Updated!');
        return redirect()->route('niyam.index');
    }
}
