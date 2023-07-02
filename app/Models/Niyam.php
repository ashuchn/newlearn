<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Niyam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'niyam_name'
    ];


    public function userNiyams()
    {
        return $this->hasMany(UserNiyamResponse::class);
    }
}
