<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNiyam extends Model
{
    use HasFactory;

    protected $table = 'user_niyam_submissions';

    protected $fillable =[
        'user_id','submitted_on'
    ];

    protected $casts = [
        'submitted_on' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
