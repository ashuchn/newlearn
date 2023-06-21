<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function usersEdit()
    {
        return view('backend.users.edit');
    }
}
