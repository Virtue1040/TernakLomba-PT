<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lombaMember extends Model
{
    /** @use HasFactory<\Database\Factories\LombaMemberFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id'
    ];

    protected $primaryKey = 'id_member';
}
