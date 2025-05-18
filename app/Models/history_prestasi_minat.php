<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_prestasi_minat extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryPrestasiMinatFactory> */
    use HasFactory;

    protected $fillable = [
        "bidang_id",
        "prestasi_id"
    ];

    protected $primaryKey = "id_prestasi_minat";

    public function bidang() {
        return $this->belongsTo(bidangMinat::class, 'bidang_id', 'id_bidang');
    }
}
