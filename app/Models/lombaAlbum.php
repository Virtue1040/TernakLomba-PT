<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaAlbum",
 *   type="object",
 *   required={"id_lombaAlbum", "lomba_id", "title", "imagePath"},
 * )
 * Class LombaAlbum
 * @package Incase\Models
 */
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

    /**
     * @OA\Property(title="id_lombaAlbum", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_lombaAlbum;

    /**
     * @OA\Property(title="lomba_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $lomba_id;

    /**
     * @OA\Property(title="title", type="string", readOnly=true)
     * @var string
    */
    private $title;

    /**
     * @OA\Property(title="imagePath", type="string", readOnly=true)
     * @var string
    */
    private $imagePath;

    /**
     * @OA\Property(title="created_at", type="timestamp", readOnly=true)
     * @var string
    */
    private $created_at;

    /**
     * @OA\Property(title="updated_at", type="timestamp", readOnly=true)
     * @var string
    */
    private $updated_at;
}
