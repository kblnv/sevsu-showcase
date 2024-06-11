<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTeam extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'users_teams';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'team_id',
        'is_moderator',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
