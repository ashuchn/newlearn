<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMobile extends Model
{
    use HasFactory;
    protected $table = 'user_mobile';

    protected $fillable =[
        'mobile','user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
