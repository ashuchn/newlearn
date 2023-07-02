<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapResult extends Model
{
    use HasFactory;
    protected $table = 'tap_results';
    protected $fillable = [
        'user_id','tap_quiz_id','marks'
    ];

    public function tapResponse()
    {
        return $this->belongsTo(TapResponse::class);
    }
}
