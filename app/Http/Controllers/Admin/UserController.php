<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Enums\Role;
use App\Models\User;
use App\Enums\Gender;
use Illuminate\Http\Request;
use App\Helpers\CarbonHelper;
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
}
