<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    protected $fillable = [
        'flow_name',
        'start_team',
        'end_team',
        'team_size',
        'can_create_task',
    ];
}
