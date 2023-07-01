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

    public function downloadGandhar()
    {
        $file= public_path('files/11 Gandhar Multiple.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, '11 Gandhar Multiple.pdf', $headers);
    }

    public function downloadSthanak()
    {
        $file= public_path('files/20 Sthanak Chataiyvandan,Stuti,Stavan.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, '20 Sthanak Chataiyvandan,Stuti,Stavan.pdf', $headers);
    }

    public function downloadAagam()
    {
        $file= public_path('files/45 Aagam Tap Multiple.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, '45 Aagam Tap Multiple.pdf', $headers);
    }
    
    public function downloadChaturvinshati()
    {
        $file= public_path('files/Chaturvinshati Multiple.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'Chaturvinshati Multiple.pdf', $headers);
    }
    
    public function downloadDharma()
    {
        $file= public_path('files/Dharma Chakra Multiple.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'Dharma Chakra Multiple.pdf', $headers);
    }
    
    public function downloadMoksh()
    {
        $file= public_path('files/Moksh Dand Tap.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'Moksh Dand Tap.pdf', $headers);
    }
    
    public function downloadShrani()
    {
        $file= public_path('files/Shrani Tap.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'Shrani Tap.pdf', $headers);
    }
    
    public function downloadSiddhi()
    {
        $file= public_path('files/Siddhi Tap Multiple.pdf');

        $headers = array(
                'Content-Type: application/pdf',
                );
        return response()->download($file, 'Siddhi Tap Multiple.pdf', $headers);
    }

    
}
