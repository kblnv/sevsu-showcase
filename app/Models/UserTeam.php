<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    use HasFactory;

    protected $table = 'users_teams';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'team_id',
        'is_moderator',
    ];
}
