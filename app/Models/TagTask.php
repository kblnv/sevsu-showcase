<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTask extends Model
{
    use HasFactory;

    protected $table = 'tags_tasks';

    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'task_id',
    ];
}
