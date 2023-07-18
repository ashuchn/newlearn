<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\Notice;
use App\Helpers\flashHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index()
    {
        $data = Notice::latest()->get();
        return view('backend.notice.index', compact('data'));
    }

    public function create()
    {
        return view('backend.notice.create');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required"
        ]);

        if($valid->fails()){
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withInput($request->all());
        }

        $data = $valid->validated();
        if(Notice::create($data)) {
            flashHelper::successResponse("Notice Created and sent to Users!");
            return redirect()->route('admin.notice.index');
        } else {
            flashHelper::errorResponse("Some error occured!");
            return redirect()->route('admin.notice.index');
        }
    }

    public function view($id)
    {
        $data = Notice::findOrFail($id);
        return view('backend.notice.view', compact('data'));
    }

    public function delete($id)
    {
        if(Notice::find($id)->delete()){
            flashHelper::successResponse("Notice Deleted!");
            return redirect()->route('admin.notice.index');
        } else {
            flashHelper::errorResponse("Some error occured!");
            return redirect()->route('admin.notice.index');
        }
    }

    public function edit($id)
    {
        $data = Notice::findOrFail($id);
        return view('backend.notice.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required"
        ]);

        if($valid->fails()){
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withInput($request->all());
        }

        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        if($notice->update()) {
            flashHelper::successResponse("Notice Updated and sent to Users!");
            return redirect()->route('admin.notice.index');
        } else {
            flashHelper::errorResponse("Some error occured!");
            return redirect()->route('admin.notice.index');
        }
    }
}
