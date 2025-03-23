<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="PenyelanggaraDetail",
 *   type="object",
 *   required={"user_id", "institue"},
 * )
 * Class PenyelanggaraDetail
 * @package Incase\Models
 */
class Penyelenggara_detail extends Model
{
    /** @use HasFactory<\Database\Factories\PenyelenggaraDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'institue'
    ];

    protected $primaryKey = 'user_id';

    /**
     * @OA\Property(title="user_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $user_id;

    /**
     * @OA\Property(title="institue", type="string", readOnly=true)
     * @var string
    */
    private $institue;

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
