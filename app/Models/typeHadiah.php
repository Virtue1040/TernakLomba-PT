<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="TypeHadiah",
 *   type="object",
 *   required={"id_typeHadiah", "lomba_id", "name"},
 * )
 * Class TypeHadiah
 * @package Incase\Models
 */
class typeHadiah extends Model
{
    /** @use HasFactory<\Database\Factories\TypeHadiahFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'name'
    ];

    protected $primaryKey = 'id_typeHadiah';

    /**
     * @OA\Property(title="id_typeHadiah", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_typeHadiah;

    /**
     * @OA\Property(title="lomba_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $lomba_id;


    /**
     * @OA\Property(title="name", type="string", readOnly=true)
     * @var string
    */
    private $name;

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
