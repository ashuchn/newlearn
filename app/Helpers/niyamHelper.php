<?php

namespace App\Helpers;

use DB;
use App\Models\User;
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

    public static function getSubmissions(int $userId = null)
    {
        if(!is_null($userId)) {
            $data = UserNiyam::where('user_id', $userId)->with('user')->get();
        } else {
            $data = UserNiyam::with('user')->get();
        }
        return $data;
    }

    public static function generateOverallResult()
    {
        $result = User::select('users.id', 'users.name')
                ->selectRaw('SUM(CASE WHEN user_niyam_responses.answer = 1 THEN 1 ELSE 0 END) AS total_answers')
                ->selectSub(function ($query) {
                    $query->selectRaw('COUNT(*)')
                        ->from('user_niyam_submissions')
                        ->whereColumn('user_niyam_submissions.user_id', 'users.id');
                    }, 'submission_count'
                    )
                ->join('user_niyam_submissions', 'users.id', '=', 'user_niyam_submissions.user_id')
                ->join('user_niyam_responses', 'user_niyam_submissions.id', '=', 'user_niyam_responses.submission_id')
                ->groupBy('users.id', 'users.name')
                ->orderBy('total_answers', 'DESC')
                ->get();
        return $result;
    }

    public static function editNiyam($id)
    {
        $data = Niyam::find($id);
        return $data;
    }

    public static function updateNiyam($id, $request)
    {
        $niyam = Niyam::find($id);
        $niyam->niyam_name = $request->niyam_name;
        if($niyam->update()){
            return true; 
        } else {
            return false;
        }
    }

}