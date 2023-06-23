<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    use HasFactory;
    protected $table = 'user_response';
    protected $fillable = [
        'user_id','quiz_id'
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

      // Define the relationship with UserAnswer
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
