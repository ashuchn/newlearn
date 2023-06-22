<?php 

namespace App\Enums;

class Role {
    const ADMIN = 1;
    const USER  = 2;

    const ROLE = [
        self::ADMIN => 'Admin',
        self::USER  => 'User',
    ];

    public static function getRoleValues()
    {
        return array_values(self::ROLE);
    }
    
    public static function getRoleIds()
    {
        return array_keys(self::ROLE);
    }

    public static function getRoleById($id)
    {
        return self::ROLE[$id];
    }
} 