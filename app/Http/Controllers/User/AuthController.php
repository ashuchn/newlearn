<?php

namespace App\Http\Controllers\User;

use Hash;
use Validator;
use App\Models\User;
use App\Enums\Gender;
use App\Models\State;
use App\Helpers\AuthHelper;
use App\Helpers\flashHelper;
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
        // return $request;
        $valid = Validator::make($request->all(),[
            "mobile"    => "required|min:10|max:10|exists:users",
            "password"  => "required"
        ], [
            'required' =>':attribute is required',
            'mobile.exists' =>':attribute does not exist',
        ]);
        

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withErrors($valid)->withInput();
        }

        $validatedData = $valid->validated();
        if(Auth::attempt(['mobile' => $validatedData['mobile'], 'password' => $validatedData['password'] ])) {
            flashHelper::successResponse('Logged in! Choose Account to continue');
            return redirect()->route('accounts');
        }
        flashHelper::errorResponse('Invalid Credentials');
        return back();
    } 

    public function registerView()
    {
        $gender = Gender::getGenders();
        $states = State::all();
        return view('frontend.auth.register', compact('gender','states'));
    }

    public function register(Request $request)
    {
        $valid = Validator::make($request->all(),[
            "name"          => "required",
            "email"         => "nullable|unique:users,email",
            "mobile"        => "required|digits:10",
            "password"      => "required|min:6",
            "state_id"      => "required",
            "city"          => "required",
            "date_of_birth" => "required|date_format:d/m/Y",
            "gender"        => ['required', Rule::in(['1', '2'])]
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back()->withErrors($valid)->withInput();
        }

        $user = AuthHelper::register($valid->validated());
        if(Auth::attempt(['mobile' => $user->mobile, 'password' => $request->password])) {
            flashHelper::successResponse('Logged in successfully!');
            return redirect()->route('accounts');
        } else {
            flashHelper::errorResponse('user created! Error while login!');
            return back();
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

    public function accounts()
    {
        $mobile = Auth::user()->mobile;
        $data = AuthHelper::accounts($mobile);
        
        if(!$data) {
            flashHelper::errorResponse('No Accounts linked!');
        }
        return view('frontend.auth.accounts', compact('data'));

    }

    public function accountLogin(Request $request)
    {
        $user = User::find($request->model);
        if(Auth::loginUsingId($user->id)) {
            \Session::put('accountChoosen', true);
            flashHelper::successResponse('Logged In!');
            return redirect()->route('dashboard');
        } else {
            flashHelper::errorResponse('Some Error Occured!');
            return back();
        }
    }
}  
