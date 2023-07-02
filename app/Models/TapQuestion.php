<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapQuestion extends Model
{
    use HasFactory;
    protected $table = 'tap_questions';
    protected $fillable = [
        'tap_quiz_id',
        'question_text',
    ];

    public function quiz()
    {
        return $this->belongsTo(TapQuiz::class);
    }

    public function answers()
    {
        return $this->hasMany(TapAnswers::class, 'question_id');
    }
}
