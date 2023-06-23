<?php

namespace App\Helpers;

use App\Models\Quiz;
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

    public static function changePublishStatus($data): jsonResponse
    {
        $update = Quiz::where('id', $request->itemId)
            ->update([
                'is_published' => $request->switchState
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
        // return view('backend.quiz.result', compact('totalMarks','totalQuestions','incorrectAnswers','correctAnswers','userResponseId','quiz'));
    }

}