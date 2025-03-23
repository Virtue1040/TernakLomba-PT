<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="VerificationToken",
 *   type="object",
 *   required={"user_id", "token"},
 * )
 * Class VerificationToken
 * @package Incase\Models
 */
class verificationToken extends Model
{
    /** @use HasFactory<\Database\Factories\VerificationTokenFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token'
    ];

    protected $primaryKey = 'id_verification';

    /**
     * @OA\Property(title="id_verification", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_verification;

    /**
     * @OA\Property(title="user_id", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $user_id;

    /**
     * @OA\Property(title="token", type="string", readOnly=true)
     * @var string
    */
    private $token;

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
