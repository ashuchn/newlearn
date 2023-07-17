<?php

namespace App\Http\Controllers\Admin;

use App\Models\Suggestion;
use App\Helpers\flashHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller
{
    public function index()
    {
        $data = Suggestion::with(['user'])->orderBy('id','desc')->get();
        return view('backend.suggestion.index', compact('data'));
    }

    public function view($id)
    {
        $data = Suggestion::with(['user'])->find($id);
        return view('backend.suggestion.view', compact('data'));
    }
}
