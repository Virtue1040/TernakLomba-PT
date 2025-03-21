<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lombaAlbum extends Model
{
    /** @use HasFactory<\Database\Factories\LombaAlbumFactory> */
    use HasFactory;

    protected $fillable = [
        "lomba_id",
        'title',
        'imagePath'
    ];

    protected $primaryKey = "id_lombaAlbum";
}
