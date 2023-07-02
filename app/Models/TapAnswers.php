<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapAnswers extends Model
{
    use HasFactory;
    protected $table = 'tap_answers';
    
    protected $fillable = [
        'question_id',
        'answer_text',
        'marks',
    ];
    
    public function question()
    {
        return $this->belongsTo(TapQuestion::class);
    }
}
