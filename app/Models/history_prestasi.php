<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_prestasi extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryPrestasiFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "juara",
        "tingkatan"
    ];

    protected $primaryKey = "id_prestasi";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }


    public function get_minat() {
        return $this->hasMany(history_prestasi_minat::class, 'prestasi_id', 'id_prestasi');
    }

    public function get_minat_text() {
        return $this->get_minat()->get()->map(fn ($minat) => $minat->bidang->name)->implode(', ');
    }
    
}
