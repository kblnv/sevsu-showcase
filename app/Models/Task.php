<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'task_name',
        'task_description',
        'customer',
        'max_projects',
        'flow_id',
    ];

    protected $casts = [
        'tags.tag_name' => 'array',
    ];

    public function flows(): BelongsTo
    {
        return $this->belongsTo(Flow::class, 'flow_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_tasks');
    }
}
