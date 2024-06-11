<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupFlow extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = 'groups_flows';

    protected $fillable = [
        'id',
        'flow_id',
        'group_id',
    ];

    // public function groups(): BelongsTo
    // {
    //     return $this->belongsTo(Group::class, 'group_id');
    // }

    // public function flows(): BelongsTo
    // {
    //     return $this->belongsTo(Flow::class, 'flow_id');
    // }
}
