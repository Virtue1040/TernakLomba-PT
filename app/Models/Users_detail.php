<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_detail extends Model
{
    /** @use HasFactory<\Database\Factories\UsersDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'bio',
        'born_date',
        'gender',
        'social_id',
        'social_type',
        'social_avatar',
        'avatarPath',
        'avatar_type'
    ];

    protected $primaryKey = 'user_id';
}
