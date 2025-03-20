<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lombaHadiah extends Model
{
    /** @use HasFactory<\Database\Factories\LombaHadiahFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'id_typeHadiah',
        'quantity'
    ];

    protected $primaryKey = 'id_hadiah';
}
