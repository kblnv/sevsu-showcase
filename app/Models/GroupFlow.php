<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupFlow extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'groups_flows';

    protected $fillable = [
        'flow_id',
        'group_id',
    ];
}
