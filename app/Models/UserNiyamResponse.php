<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNiyamResponse extends Model
{
    use HasFactory;
    protected $table  = 'user_niyam_responses';

    protected $fillable = [
        'submission_id','niyam_id','answer'
    ];

    public function niyam()
    {
        return $this->belongsTo(Niyam::class);
    }
    
}
