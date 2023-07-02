<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapQuiz extends Model
{
    use HasFactory;
    protected $table = 'tap_quizzes';

    protected $fillable = [
        'title',
        'is_published',
        'description',
        'start_date'
    ];

    public function questions()
    {
        return $this->hasMany(TapQuestion::class);
    }

    public function getHasUserGivenQuizAttribute()
    {
        $userResponse = TapResponse::where([
            ['tap_quiz_id', $this->id],
            ['user_id', auth()->user()->id]
        ])->exists();

        return $userResponse ? true : false;
    }
}
