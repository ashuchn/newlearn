<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    protected $table = 'user_answer';

    protected $fillable = [
        'user_response_id','question_id','answer_id'
    ];

    // Define the relationship with UserResponse
    public function userResponse()
    {
        return $this->belongsTo(UserResponse::class);
    }

    // Define the relationship with Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Define the relationship with Answer
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
