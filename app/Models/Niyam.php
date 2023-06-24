<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niyam extends Model
{
    use HasFactory;
    protected $fillable = [
        'niyam_name'
    ];


    public function userNiyams()
    {
        return $this->hasMany(UserNiyamResponse::class);
    }
}
