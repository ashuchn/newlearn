<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QnaController extends Controller
{
    public function index()
    {
        return view('frontend.qna.index');
    }
}
