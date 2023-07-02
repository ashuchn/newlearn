<?php

namespace App\Helpers;

use App\Helpers\CarbonHelper;
use App\Models\TapQuiz;

class TapHelper {

    public static function create($data)
    {
        $data['start_date'] = CarbonHelper::formatDate($data['start_date'], 'd/m/Y');
        // return $data;
        return TapQuiz::create($data);
    }

    public static function changePublishStatus($data)
    {
        $update = TapQuiz::where('id', $data->itemId)
            ->update([
                'is_published' => $data->switchState
            ]);
            if($update) {
                return response()->json([
                    "success" => true,
                    "message" => "data saved",
                    "data" => $update
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "error!",
                ]);
            }
    }


}