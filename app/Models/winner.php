<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class winner extends Model
{
    /** @use HasFactory<\Database\Factories\WinnerFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "user_alias",
        "hadiah_id",
        "juara"
    ];

    protected $primaryKey = "id_winner";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id_user");
    }

    public function hadiah() {
        return $this->belongsTo(lombaHadiah::class, "hadiah_id", "id_hadiah");
    }
}
