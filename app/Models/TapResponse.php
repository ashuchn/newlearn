<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','submitted_on'
    ];

    public function submission()
    {
        return $this->hasOne(TapSubmission::class);
    }
}
