<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    /** @use HasFactory<\Database\Factories\LombaFactory> */
    use HasFactory;

    protected $fillable = [
        'max_member',
        'min_member',
        'lombaCategory_id',
        'start_date',
        'end_date'
    ];

    protected $primaryKey = "id_lomba";
}
