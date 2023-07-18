<?php

namespace App\Http\Controllers\User;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Helpers\flashHelper;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index()
    {
        $data = Notice::latest()->paginate(5);
        // return $data->current_page;
        return view('frontend.notice.index', compact('data'));
    }
}
