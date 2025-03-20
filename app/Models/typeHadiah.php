<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeHadiah extends Model
{
    /** @use HasFactory<\Database\Factories\TypeHadiahFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'name'
    ];

    protected $primaryKey = 'id_typeHadiah';
}
