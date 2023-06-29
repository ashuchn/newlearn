<?php

namespace App\Helpers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserResponse;
use App\Helpers\CarbonHelper;

class QuizHelper {

    public static function create(array $data): object
    {
        $data['start_date'] = CarbonHelper::formatDate($data['start_date'], 'd/m/Y');
        return Quiz::create($data);
    }

    public static function saveQuestionAnswer($quizId, $data): bool
    {
        try {
            // Create a new question
            $question           = new Question();
            $question->quiz_id   = $quizId;
            $question->question = $data['question'];
            $question->save();

            // Save the answers
            foreach ($data['answer'] as $key => $answerText) {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer_text = $answerText;
                $answer->is_correct = $key + 1 === (int)$data['correctAnswer'] ? 1 : 0;
                $answer->save();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function changePublishStatus($data)
    {
        $update = Quiz::where('id', $data->itemId)
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


    public static function quizQuestionDelete($questionId)
    {
        $delete = Question::find($questionId)->delete();
        return $delete;
    }

    public static function viewSubmissions(int $quizId)
    {
        $users = UserResponse::where('quiz_id', $quizId)->get();
        return $users;
    }

    public static function quizResult($quiz, $user)
    {
        $correctAnswers     = 0;
        $incorrectAnswers   = 0;
        $perAnswerMarks     = 5;
        $totalQuestions     = Question::where('quiz_id', $quiz->id)->count();
        $userResponse       = UserResponse::where([
            ['quiz_id', $quiz->id],
            ['user_id', $user->id]
        ])->first();
        $submittedAnswers   = UserAnswer::where('user_response_id', $userResponse->id)->pluck('answer_id');
        foreach($submittedAnswers as $answer) {
            $isCorrect = Answer::where('id', $answer)->where('is_correct', 1)->exists();
            if ($isCorrect) {
                $correctAnswers++;
            } else {
                $incorrectAnswers++;
            }
        }

        $totalMarks = $correctAnswers * $perAnswerMarks;
        return [
            'totalMarks'        => $totalMarks,
            'totalQuestions'    => $totalQuestions,
            'incorrectAnswers'  =>$incorrectAnswers,
            'correctAnswers'    =>$correctAnswers,
            'userResponse'      =>$userResponse,
            'quiz'              =>$quiz
        ];
    }

    public static function generateReport(int $quizId)
    {
        $totalQuestions     = Question::where('quiz_id', $quizId)->count();
        $userResponses      = UserResponse::where([
            ['quiz_id', $quizId]
        ])->get();
        $usersReport = array();
        $totalMarks = 0;
        foreach($userResponses as $userResponse) {
            $userId = $userResponse->user_id;
            $correctAnswers     = 0;
            $incorrectAnswers   = 0;
            $perAnswerMarks     = 5;
            $submittedAnswers   = UserAnswer::where('user_response_id', $userResponse->id)->pluck('answer_id');
            foreach($submittedAnswers as $answer) {
                $isCorrect = Answer::where('id', $answer)->where('is_correct', 1)->exists();
                if ($isCorrect) {
                    $correctAnswers++;
                } else {
                    $incorrectAnswers++;
                }
                $totalMarks = $correctAnswers * $perAnswerMarks;
            }
            array_push($usersReport, ['totalMarks' => $totalMarks,'userId' => $userId ]);
        }
        $collection = collect($usersReport);
        // $sortBy = 'totalMarks';
        // $sorted = $collection->sortByDesc($sortBy);
        $userIds = $collection->pluck('userId')->toArray(); // Get unique user ids from the sorted collection
        // Fetch the usernames for the corresponding user ids
        $usernames = User::whereIn('id', $userIds)->pluck('name', 'id');

        // Iterate over the sorted collection and relate userId with username
        $collection->transform(function ($item) use ($usernames) {
            $item['username'] = $usernames[$item['userId']] ?? null;
            return $item;
        });

        return $collection;
    }

}