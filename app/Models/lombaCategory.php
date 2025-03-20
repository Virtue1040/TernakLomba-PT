<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lombaCategory extends Model
{
    /** @use HasFactory<\Database\Factories\LombaCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = "id_lombaCategory";
}
