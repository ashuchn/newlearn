<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Helpers\flashHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function logout()
    {
        Auth::logout();
        \Session::flush();
        return redirect()->route('admin.login');
    }

    public function loginPost(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "email"     => "required|exists:users",
            "password"  => "required"
        ], [
            'required' =>':attribute is required',
            'email.exists' =>':attribute does not exist',
        ]);

        if($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        if(Auth::attempt($valid->validated())) {
            return redirect()->route('admin.dashboard');
        }
        return back()->with('err_msg','Invalid Credentials');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function contactUs()
    {
        $data  = ContactUs::find(1);
        return view('frontend.contactUs', compact('data'));
    }

    public function showContactUs()
    {
        $data = ContactUs::first();
        return view('backend.contactUs.index', compact('data'));
    }

    public function updateContactUs(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'contact_person_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required'
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back();
        }
        
        $update = ContactUs::find(1);
        $update->contact_person_name = $request->contact_person_name;
        $update->email = $request->email;
        $update->mobile_number = $request->mobile_number;
        if($update->update()) {
            flashHelper::successResponse('Details Updated!');
            return redirect()->route('admin.contactUs');
        } else {
            flashHelper::errorResponse('Some error occured!');
            return redirect()->route('admin.contactUs');
        }
    }
}
