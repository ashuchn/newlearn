<?php

namespace App\Http\Controllers\User;

use Validator;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Helpers\flashHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller
{
    public function index()
    {
        return view('frontend.suggestion.index');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "subject"       => "required",
            "description"   => "required|max:250"
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withErrors($valid)->withInput();
        }
        $isAnonymous = $request->input('anonymous') ?? null;
        $suggestion                 = new Suggestion;
        $suggestion->user_id        = !is_null($isAnonymous) ? null : Auth::id(); 
        $suggestion->subject        = $request->subject;
        $suggestion->description    = $request->description;
        if($suggestion->save()) {
            flashHelper::successResponse('Suggestion sent!');
            return redirect()->route('suggestion.index');
        } else {
            flashHelper::errorResponse('Some error occured!');
            return redirect()->route('suggestion.index');
        }
        
    }
}
