<?php

namespace App\Helpers;

use DB;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Result;
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

        $data = DB::table('users')
        ->join('user_response', 'users.id', '=', 'user_response.user_id')
        ->join('user_answer', 'user_response.id', '=', 'user_answer.user_response_id')
        ->join('quizzes', 'user_response.quiz_id', '=', 'quizzes.id')
        ->join('questions', 'user_answer.question_id', '=', 'questions.id')
        ->join('answers', 'user_answer.answer_id', '=', 'answers.id')
        ->where('quizzes.id', $quizId)
        ->select('users.id', 'users.name', DB::raw('SUM(CASE WHEN answers.is_correct = 1 THEN 1 ELSE 0 END) as total_marks'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('total_marks')
        ->get();

        return $data;
        /*
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
        */
    }

    public static function calculateOverallResults()
    {
        // $userResponses = UserResponse::all();

        // foreach ($userResponses as $userResponse) {
        //     $result = Result::where('user_id', $userResponse->user_id)
        //         ->where('quiz_id', $userResponse->quiz_id)
        //         ->first();
    
        //     if (!$result) {
        //         $marks = UserAnswer::where('user_response_id', $userResponse->id)
        //             ->join('answers', 'user_answer.answer_id', '=', 'answers.id')
        //             ->where('answers.is_correct', 1)
        //             ->count();
    
        //         Result::create([
        //             'user_id' => $userResponse->user_id,
        //             'quiz_id' => $userResponse->quiz_id,
        //             'marks' => $marks,
        //         ]);
        //     }
        // }
        $results = UserResponse::join('user_answer', 'user_response.id', '=', 'user_answer.user_response_id')
        ->join('answers', 'user_answer.answer_id', '=', 'answers.id')
        ->where('answers.is_correct', 1)
        ->groupBy('user_response.user_id')
        ->groupBy('user_response.quiz_id')
        ->select(
            'user_response.user_id',
            'user_response.quiz_id',
            DB::raw('COUNT(answers.id) as total_marks')
        )
        ->get();

    foreach ($results as $result) {
        $existingResult = Result::where('user_id', $result->user_id)
            ->where('quiz_id', $result->quiz_id)
            ->first();

        if ($existingResult) {
            $existingResult->marks = $result->total_marks;
            $existingResult->save();
        } else {
            Result::create([
                'user_id' => $result->user_id,
                'quiz_id' => $result->quiz_id,
                'marks' => $result->total_marks,
            ]);
        }
    }
    
    $toppers = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->select('results.user_id', 'users.name', DB::raw('SUM(results.marks) AS total_marks'))
            ->groupBy('results.user_id', 'users.name')
            ->orderByDesc('total_marks')
            ->get();
    
        return $toppers;
    }

}