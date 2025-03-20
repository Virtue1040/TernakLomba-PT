<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara_detail extends Model
{
    /** @use HasFactory<\Database\Factories\PenyelenggaraDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institue'
    ];

    protected $primaryKey = 'user_id';
}
