<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="Lomba",
 *   type="object",
 *   required={"id_lomba", "max_member", "min_member", "lombaCategory_id", "start_date", "end_date"},
 * )
 * Class Lomba
 * @package Incase\Models
 */
class Lomba extends Model
{
    /** @use HasFactory<\Database\Factories\LombaFactory> */
    use HasFactory;

    protected $fillable = [
        'max_member',
        'min_member',
        'lombaCategory_id',
        'start_date',
        'end_date'
    ];

    protected $primaryKey = "id_lomba";

    public function lombaCategory()
    {
        return $this->belongsTo(lombaCategory::class);
    }

    public function lombaDetail()
    {
        return $this->hasOne(Lomba_detail::class);
    }

    /**
     * @OA\Property(title="id_lomba", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_lomba;

    /**
     * @OA\Property(title="max_member", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $max_member;

    /**
     * @OA\Property(title="min_member", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $min_member;

    /**
     * @OA\Property(title="lombaCategory_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $lombaCategory_id;

    /**
     * @OA\Property(title="start_date", type="timestamp", readOnly=true)
     * @var string
    */
    private $start_date;
    
    /**
     * @OA\Property(title="end_date", type="timestamp", readOnly=true)
     * @var string
    */
    private $end_date;

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
