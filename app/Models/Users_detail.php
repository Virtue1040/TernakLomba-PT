<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="UserDetail",
 *   type="object",
 *   required={"user_id", "first_name", "last_name", "bio" , "born_date", "gender", "social_id", "social_type", "social_avatar", "avatarPath", "avatar_type"},
 * )
 * Class UserDetail
 * @package Incase\Models
 */
class Users_detail extends Model
{
    /** @use HasFactory<\Database\Factories\UsersDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'bio',
        'born_date',
        'gender',
        'social_id',
        'social_type',
        'social_avatar',
        'avatarPath',
        'avatar_type'
    ];

    protected $primaryKey = 'user_id';

    // public function full_name()
    // {
    //     return trim("{$this->first_name} {$this->last_name}");
    // }

    /**
     * @OA\Property(title="user_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $user_id;

    /**
     * @OA\Property(title="first_name", type="string")
     * @var string
    */
    private $first_name;

    /**
     * @OA\Property(title="last_name", type="string")
     * @var string
    */
    private $last_name;

    /**
     * @OA\Property(title="bio", type="string")
     * @var string
    */
    private $bio;

    /**
     * @OA\Property(title="born_date", type="string", format="date")
     * @var string
    */
    private $born_date;

    /**
     * @OA\Property(title="gender", type="string")
     * @var string
    */
    private $gender;

    /**
     * @OA\Property(title="social_id", type="string")
     * @var string
    */
    private $social_id;

    /** 
     * @OA\Property(title="social_type", type="string")
     * @var string
    */
    private $social_type;

    /**
     * @OA\Property(title="social_avatar", type="string")
     * @var string
    */
    private $social_avatar;

    /**
     * @OA\Property(title="avatarPath", type="string")
     * @var string
    */
    private $avatarPath;

    /**
     * @OA\Property(title="avatar_type", type="boolean")
     * @var boolean
    */
    private $avatar_type;

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
