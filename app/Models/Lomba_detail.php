<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba_detail extends Model
{
    /** @use HasFactory<\Database\Factories\LombaDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'title',
        'description',
    ];

    protected $primaryKey = "lomba_id";
}
