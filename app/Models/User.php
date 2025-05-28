<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Str;

/**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   required={"id_user", "max_member", "email", "password"},
 * )
 * Class User
 * @package Incase\Models
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function detail()
    {
        return $this->hasOne(Users_detail::class, 'user_id', 'id_user');
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa_detail::class, 'user_id', 'id_user');
    }

    public function prestasi()
    {
        return $this->hasMany(history_prestasi::class, 'user_id', 'id_user');
    }


    public function user_detail() {
        return $this->hasOne(Users_detail::class, 'user_id', 'id_user');
    }

    public function get_prestasi() {
        return $this->hasMany(history_prestasi::class, 'user_id', 'id_user');
    }
    
    public function get_associated() {
        return $this->hasOne(Mahasiswa_detail::class, 'user_id', 'id_user') ?? $this->hasOne(Penyelenggara_detail::class, 'user_id', 'id_user');
    }

    public function get_ikut_lomba() {
        return $this->hasManyThrough(lombaTeam::class, lombaMember::class, 'user_id', 'id_team', 'id_user', 'team_id');
    }

    public function check_isJoinedLomba($id_lomba) {
        return $this->get_ikut_lomba()->where('lomba_id', $id_lomba)->exists();
    }

    public function get_minat() {
        return $this->hasMany(MahasiswaMinat::class, 'user_id', 'id_user');
    }

    public function get_minat_text() {
        return $this->get_minat()->get()->map(fn ($minat) => $minat->bidang->name)->implode(', ');
    }

    public function get_joined_compspace() {
        return $this->hasMany(lombaMember::class, 'user_id', 'id_user');
    }

    public function get_total_joined_lomba() {
        return $this->get_joined_compspace()->select('user_id')->distinct()->count();
    }

    public function get_total_win_lomba() {
        return $this->hasMany(winner::class, 'user_id', 'id_user')->count();
    }

    public function get_winrate() {
        return $this->get_total_win_lomba() > 0 ? ($this->get_total_joined_lomba() / $this->get_total_win_lomba()) * 100 : 0;
    }

    /**
     * Override createToken.
     *
     * @param string $name
     * @param array $abilities
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], ?string $textToken = null)
    {
        if (is_null($textToken)) {
            $textToken = Str::random(40);
        }

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = $textToken),
            'abilities' => $abilities,
        ]);

        return new \Laravel\Sanctum\NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

    /**
     * @OA\Property(title="id_user", type="integer", format="int64", readOnly=true)
     * @var integer
    */
    private $id_user;

    /**
     * @OA\Property(title="username", type="string", readOnly=true)
     * @var string
    */
    private $username;

    /**
     * @OA\Property(title="email", type="string", format="email", readOnly=true)
     * @var string
    */
    private $email;

    /**
     * @OA\Property(title="password", type="string", format="password", readOnly=true)
     * @var string
    */
    private $password;

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
