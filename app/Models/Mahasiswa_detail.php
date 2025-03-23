<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="MahasiswaDetail",
 *   type="object",
 *   required={"user_id", "kampus", "jurusan"},
 * )
 * Class MahasiswaDetail
 * @package Incase\Models
 */
class Mahasiswa_detail extends Model
{
    /** @use HasFactory<\Database\Factories\MahasiswaDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kampus',
        'jurusan'
    ];

    protected $primaryKey = 'user_id';

    /**
     * @OA\Property(title="user_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $user_id;

    /**
     * @OA\Property(title="kampus", type="string", readOnly=true)
     * @var string
    */
    private $kampus;

    /**
     * @OA\Property(title="jurusan", type="string", readOnly=true)
     * @var string
    */
    private $jurusan;

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
