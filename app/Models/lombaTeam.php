<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="LombaTeam",
 *   type="object",
 *   required={"id_team", "lomba_id", "isApproved"},
 * )
 * Class LombaTeam
 * @package Incase\Models
 */
class lombaTeam extends Model
{
    /** @use HasFactory<\Database\Factories\LombaTeamFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'leader_user_id',
        'isApproved'
    ];
    
    protected $primaryKey = 'id_team';

    /**
     * @OA\Property(title="id_team", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_team;

    /**
     * @OA\Property(title="lomba_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $lomba_id;

    /**
     * @OA\Property(title="isApproved", type="boolean", readOnly=true)
     * @var boolean
    */
    private $isApproved;

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
