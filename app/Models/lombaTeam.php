<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lombaTeam extends Model
{
    /** @use HasFactory<\Database\Factories\LombaTeamFactory> */
    use HasFactory;

    protected $fillable = [
        'lomba_id',
        'isApproved'
    ];
    
    protected $primaryKey = 'id_team';
}
