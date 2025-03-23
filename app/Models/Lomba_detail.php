<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaDetail",
 *   type="object",
 *   required={"lomba_id", "title", "description"},
 * )
 * Class LombaDetail
 * @package Incase\Models
 */
class Lomba_detail extends Model
{
    /** @use HasFactory<\Database\Factories\LombaDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'title',
        'description',
    ];

    protected $primaryKey = "lomba_id";

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
     * @OA\Property(title="description", type="string", readOnly=true)
     * @var string
    */
    private $description;

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
