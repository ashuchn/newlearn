<?php

namespace App\Helpers;

use Hash;
use App\Models\User;
use App\Helpers\CarbonHelper;

class AuthHelper {

    /**
     * Performs registeration of User
     * @param $request
     * @return jsonResponse $user 
     */
    public static function register(array $request)
    {

        $newDate                = CarbonHelper::formatDate($request['date_of_birth'],'d/m/Y');
        $user                   = new User;
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->mobile           = $request['mobile'];
        $user->date_of_birth    = $newDate;
        $user->gender           = $request['gender'];
        $user->password         = Hash::make($request['password']);
        $user->save();

        return $user;

    }

}