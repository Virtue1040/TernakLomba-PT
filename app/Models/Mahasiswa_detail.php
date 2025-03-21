<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa_detail extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kampus',
        'jurusan'
    ];

    protected $primaryKey = 'user_id';
}
