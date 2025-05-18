<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMinat extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaMinatFactory> */
    use HasFactory;

    protected $fillable = [
        'bidang_id',
        'user_id'
    ];

    protected $primaryKey = "id_mahasiswa_minat";

    public function bidang() {
        return $this->belongsTo(bidangMinat::class, "bidang_id", "id_bidang");
    }
}
