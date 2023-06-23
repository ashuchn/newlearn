<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use App\Enums\Role;
use App\Models\User;
use App\Enums\Gender;
use Illuminate\Http\Request;
use App\Helpers\CarbonHelper;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=' , 1)->get();
        return view('backend.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $user->role = Role::getRoleById($user->role_id);
        $user->gender_name = Gender::getGenderById($user->gender);
        $user->joined_on = Carbon::parse($user->created_at)->toDayDateTimeString();

        $gender = Gender::getGenders();

        return view('backend.users.edit', compact('user','gender'));
    }

    public function update(User $user, Request $request)
    {
        $valid = Validator::make($request->all(),[
            "name"          =>  "required",
            "email"         =>  ['required','unique:users',Rule::unique('users')->ignore($user)],
            "mobile"        =>  ['required','unique:users',Rule::unique('users')->ignore($user)],
            "gender"        =>  ['required',Rule::in('1','2')]
        ]);

        if($valid->fails()) {
            flash()->addError($valid->errors()->first());
            return back();
        }

        $user->fill($valid->validated());
        if($user->save()) {
            flash()->addSuccess('User Edited Successfully');
            return redirect()->route('users.edit', ['id',$user->id]);
        } else {
            flash()->addError('Some error occured!');
            return redirect()->route('users.edit', ['id',$user->id]);
        }
    }

}