<?php

namespace App\Helpers;

use Hash;
use App\Models\User;
use App\Models\UserMobile;
use App\Helpers\CarbonHelper;
use Illuminate\Database\Eloquent\Collection;

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
        $user->state_id         = $request['state_id'];
        $user->city             = $request['city'];
        $user->save();

        UserMobile::create([
            "mobile"    => $request['mobile'],
            "user_id"   => $user->id
        ]);

        return $user;
    }

    public static function accounts(string $mobile): Collection
    {
        $data = UserMobile::where('mobile', $mobile)->pluck('user_id');
        $users = User::whereIn('id', $data)->get();
        return $users;
    }

}