<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaMember",
 *   type="object",
 *   required={"id_member", "team_id", "role", "isLeader"},
 * )
 * Class LombaMember
 * @package Incase\Models
 */
class lombaMember extends Model
{
    /** @use HasFactory<\Database\Factories\LombaMemberFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'role',
        'isLeader'
    ];

    protected $primaryKey = 'id_member';

    /**
     * @OA\Property(title="id_member", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_member;

    /**
     * @OA\Property(title="team_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $team_id;

    /**
     * @OA\Property(title="role", type="string", readOnly=true)
     * @var string
    */
    private $role;

    /**
     * @OA\Property(title="isLeader", type="boolean", readOnly=true)
     * @var boolean
    */
    private $isLeader;

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
