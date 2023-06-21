<?php

namespace App\Http\Controllers\User;

use Hash;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
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
            return redirect()->route('dashboard');

        }
        return back()->with('err_msg','Invalid Credentials');
    } 

    public function register(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "name"      => "required",
            "email"     => "required|unique:users",
            "mobile"    => "required|unique:users",
            "password"  =>"required|min:6"
        ]);

        if($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::attempt(['email' => $user->email, 'password' => $user->password]);

        return route('dashboard')->with('success','Logged in successfully!');
    }

    public function dashboard()
    {
        return view('frontend.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        \Session::flush();
        return redirect()->route('login');
    }
}  
