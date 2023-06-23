<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';

    protected $fillable = [
        'quiz_name','start_date'
    ];

    protected $casts = [
        'start_date' => 'date'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Define the relationship with UserResponse
    public function userResponses()
    {
        return $this->hasMany(UserResponse::class);
    }

    public function getHasUserGivenQuizAttribute()
    {
        $userResponse = UserResponse::where([
            ['quiz_id', $this->id],
            ['user_id', auth()->user()->id]
        ])->exists();

        return $userResponse ? true : false;
    }
}
