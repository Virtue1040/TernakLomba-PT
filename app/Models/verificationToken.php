<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verificationToken extends Model
{
    /** @use HasFactory<\Database\Factories\VerificationTokenFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token'
    ];

    protected $primaryKey = 'id_verification';
}
