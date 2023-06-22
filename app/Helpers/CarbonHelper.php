<?php 

namespace App\Helpers;
use Carbon\Carbon;


class CarbonHelper {

    public static function formatDate($date, $format)
    {
        return Carbon::createFromFormat($format, $date)->format('Y-m-d');
    }

}