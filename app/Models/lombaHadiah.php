<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaHadiah",
 *   type="object",
 *   required={"id_hadiah", "lomba_id", "typeHadiah_id", "quantity"},
 * )
 * Class LombaHadiah
 * @package Incase\Models
 */
class lombaHadiah extends Model
{
    /** @use HasFactory<\Database\Factories\LombaHadiahFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'typeHadiah_id',
        'quantity'
    ];

    protected $primaryKey = 'id_hadiah';

    /**
     * @OA\Property(title="id_hadiah", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_hadiah;

    /**
     * @OA\Property(title="lomba_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $lomba_id;

    /**
     * @OA\Property(title="typeHadiah_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $typeHadiah_id;

    /**
     * @OA\Property(title="quantity", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $quantity;

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
