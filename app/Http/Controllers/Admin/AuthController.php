<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
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
}
