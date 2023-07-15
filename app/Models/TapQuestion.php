<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'tap_text',
        'marks',
        'time_of_the_day'
    ];

    
}