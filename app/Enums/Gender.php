<?php 

namespace App\Enums;

class Gender {
    const MALE      = 1;
    const FEMALE    = 2;

    const GENDER = [
        self::MALE      => 'Male',
        self::FEMALE    => 'Female',
    ];

    public static function getGenders()
    {
        return self::GENDER;
    }

    public static function getGenderById($id)
    {
        return self::GENDER[$id];
    }
} 