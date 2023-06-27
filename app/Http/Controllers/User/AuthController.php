<?php

namespace App\Http\Controllers\User;

use Hash;
use Validator;
use App\Models\User;
use App\Enums\Gender;
use App\Models\State;
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
        // return $request;
        $valid = Validator::make($request->all(),[
            "mobile"    => "required|exists:users",
            "password"  => "required"
        ], [
            'required' =>':attribute is required',
            'mobile.exists' =>':attribute does not exist',
        ]);
        

        if($valid->fails()) {
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addError($valid->errors()->first());
            return back()->withErrors($valid)->withInput();
        }

        $validatedData = $valid->validated();
        if(Auth::attempt(['mobile' => $validatedData['mobile'], 'password' => $validatedData['password'] ])) {
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addSuccess('Logged in! Choose Account to continue');
            return redirect()->route('accounts');
        }
        flash()->options([
            'timeout' => 3000,
            'position' => 'top-center',
        ])->addError('Invalid Credentials');
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
            "name"          =>  "required",
            "email"         =>  "sometimes|nullable|unique:users",
            "mobile"        =>  "required",
            "password"      =>  "required|min:6",
            "state_id"      =>  "required",
            "city"          => "required",
            "date_of_birth" =>  "required|date_format:d/m/Y",
            "gender"        =>  ['required',Rule::in('1','2')]
        ]);

        if($valid->fails()) {
            flash()->addError($valid->errors()->first());
            return back()->withErrors($valid)->withInput();
        }

        $user = AuthHelper::register($valid->validated());
        if(Auth::attempt(['mobile' => $user->mobile, 'password' => $request->password])) {
            return redirect()->route('accounts')->with('success','Logged in successfully!');
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

    public function accounts()
    {
        $mobile = Auth::user()->mobile;
        $data = AuthHelper::accounts($mobile);
        
        if(!$data) {
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addError('No Accounts linked!');
        }
        return view('frontend.auth.accounts', compact('data'));

    }

    public function accountLogin(Request $request)
    {
        $user = User::find($request->model);
        // return Auth::loginUsingId($user->id);
        // return Auth::attempt(['mobile' => $user->mobile, 'password' => $user->password]);
        if(Auth::loginUsingId($user->id)) {
            \Session::put('accountChoosen', true);
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addSuccess('Logged In!');
            return redirect()->route('dashboard');
        } else {
            flash()->options([
                'timeout' => 3000,
                'position' => 'top-center',
            ])->addError('Some Error Occured!');
            return back();
        }
    }
}  
