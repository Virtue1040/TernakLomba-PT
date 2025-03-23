<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaCategory",
 *   type="object",
 *   required={"id_lombaCategory", "name"},
 * )
 * Class LombaCategory
 * @package Incase\Models
 */
class lombaCategory extends Model
{
    /** @use HasFactory<\Database\Factories\LombaCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = "id_lombaCategory";

    /**
     * @OA\Property(title="id_lombaCategory", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_lombaCategory;
    
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
