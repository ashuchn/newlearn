<?php

namespace App\Helpers;

class flashHelper {

    public static function successResponse($message,)
    {
        return self::responseGenerator($message, 'success');
    }

    public static function errorResponse($message)
    {
        return self::responseGenerator($message, 'error');
    }
    
    private static function responseGenerator($message, $type)
    {
        flash()->options([
            'timeout' => 5000, // 5 seconds
            'position' => 'top-center',
        ])->{"add" . $type}($message);
    }

}