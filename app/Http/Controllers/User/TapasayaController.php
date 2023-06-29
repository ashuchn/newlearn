<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TapasayaController extends Controller
{
    public function index()
    {
        return view('frontend.tapasaya.index');
    }

    public function downloadTapvidhi()
    {
        //PDF file is stored under project/public/download/info.pdf
        // $file= url('public/files/tap_vidhi.pdf');
        $file= public_path('files/tap_vidhi.pdf');
        // return $file;

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'tap_vidhi.pdf', $headers);
    }
}
