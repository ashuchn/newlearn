<?php

namespace App\Helpers;

use App\Models\Niyam;
use App\Models\UserNiyam;
use App\Models\UserNiyamResponse;

class niyamHelper {

    public static function saveNiyam(array $data)
    {
        return Niyam::create($data);
    }

    public static function deleteNiyam(int $id): bool
    {
        return Niyam::find($id)->delete();
    }

    public static function saveUserResponse($request): array
    {
        try {
            // save that user has submitted niyam today
            $submission = UserNiyam::create([
                'user_id'       => auth()->user()->id,
                'submitted_on'  => \Carbon\Carbon::now()->format('Y-m-d')
            ]);

            if($request->has('niyam')){
                $answers = $request->niyam;

                foreach($answers as $niyamId => $optionId) {
                    UserNiyamResponse::create([
                        "submission_id" => $submission->id,
                        "niyam_id"      => $niyamId,
                        "answer"        => $optionId
                    ]);
                }
                return [
                    'success'   => true,
                    'data'      => $submission
                ];
            }
            return [
                'success'   => true,
                'data'      => $submission
            ];
        } catch (\Exception $e) {
            return [
                'success'   => false
            ];
        }
    }

    public static function getSubmissions(int $userId)
    {
        $data = UserNiyam::where('user_id', $userId)->with('user')->get();
        return $data;
    }

}