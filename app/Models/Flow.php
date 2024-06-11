<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flow extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'flow_name',
        'take_before',
        'finish_before',
        'max_team_size',
        'can_create_task',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'groups_flows');
    }
}
