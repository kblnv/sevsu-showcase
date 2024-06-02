<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'team_name',
        'team_description',
        'password',
        'task_id',
    ];

    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
