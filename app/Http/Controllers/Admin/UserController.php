<?php

namespace App\Http\Controllers\Admin;

use DB;
use Hash;
use Validator;
use Carbon\Carbon;
use App\Enums\Role;
use App\Models\User;
use App\Models\State;
use App\Enums\Gender;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Helpers\CarbonHelper;
use App\Helpers\flashHelper;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users as u')
                ->select('u.*', 's.name as state')
                ->leftJoin('states as s', 's.id', '=', 'u.state_id')
                ->where('u.role_id', '!=', 1)
                ->get();


        $users = $data->map(function($user) {
                        $user->gender = $user->gender == 1 ? "Male" : "Female";
                        return $user;
                });
        return view('backend.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
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
            flashHelper::errorResponse($valid->errors()->first());
            return back();
        }

        $user->fill($valid->validated());
        if($user->save()) {
            flashHelper::successResponse('User Edited Successfully');
            return redirect()->route('user.edit', ['id'=>$user->id]);
        } else {
            flashHelper::errorResponse('Some error occured!');
            return redirect()->route('user.edit', ['id'=>$user->id]);
        }
    }

    public function exportUsers()
    {
        return new UsersExport();
    }

    public function changePassword(Request $request, $id)
    {
        $valid = Validator::make($request->all(),[
            "password"          =>  "required|required_with:confirm_password|same:confirm_password",
            "confirm_password"  =>  "required",
        ]);

        if($valid->fails()) {
            flashHelper::errorResponse($valid->errors()->first());
            return back();
        }
        
        $user = User::find($id);

        $currentPassword    = $request->password;
        $oldPassword        = $user->password;
        if(Hash::check($currentPassword, $oldPassword)) {
            flashHelper::errorResponse('Old Password and New Password are same!');
            return back();
        }
        $user->password = Hash::make($request->password);
        $user->password_last_changed_at = NOW();
        if($user->update()) {
            flashHelper::successResponse('Password updated Successfully');
            return redirect()->route('user.edit', ['id'=>$id]);
        } else {
            flashHelper::errorResponse('Unable to update password!');
            return redirect()->route('user.edit', ['id'=>$id]);
        }

    }

}
