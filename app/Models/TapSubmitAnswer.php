<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapSubmitAnswer extends Model
{
    use HasFactory;

    protected $table = 'tap_answer_submission';

    protected $fillable = [
        'tap_response_id','question_id','answer_id','marks'
    ];

    public function tapResponse()
    {
        return $this->belongsTo(TapResponse::class);
    }

    public function question()
    {
        return $this->belongsTo(TapQuestion::class);
    }

    public function answer()
    {
        return $this->belongsTo(TapAnswer::class);
    }
}
