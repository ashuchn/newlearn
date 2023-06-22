<?php

namespace App\Http\Controllers\User;

use Hash;
use Validator;
use App\Models\User;
use App\Enums\Gender;
use App\Helpers\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function loginView()
    {
        return view('frontend.auth.login');
    }

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

    public function registerView()
    {
        $gender = Gender::getGenders();
        return view('frontend.auth.register', compact('gender'));
    }

    public function register(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "name"          =>  "required",
            "email"         =>  "required|unique:users",
            "mobile"        =>  "required|unique:users",
            "password"      =>  "required|min:6",
            "date_of_birth" =>  "required|date_format:d/m/Y",
            "gender"        =>  ['required',Rule::in('1','2')]
        ]);

        if($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        $user = AuthHelper::register($valid->validated());
        if(Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success','Logged in successfully!');
        } else {
            return back()->with('err_msg', 'user created! Error while login.');
        }

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
