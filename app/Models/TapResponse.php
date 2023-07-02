<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapResponse extends Model
{
    use HasFactory;
    protected $table = 'tap_response';
    
    protected $fillable = [
        'user_id','tap_quiz_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tapQuiz()
    {
        return $this->belongsTo(TapQuiz::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(TapSubmitAnswer::class);
    }

}
