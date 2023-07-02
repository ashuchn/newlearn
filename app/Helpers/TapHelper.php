<?php

namespace App\Helpers;

use App\Models\TapQuestion;

class TapHelper {

    public static function create($data)
    {
        return TapQuestion::create($data);
    }
}