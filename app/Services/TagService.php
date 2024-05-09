<?php

namespace App\Services;

use App\Contracts\TagContract;
use App\Models\TagTask;

class TagService implements TagContract
{
    public function getTags(string $taskId): array
    {
        return TagTask::select('tags.tag_name')
            ->join('tags', 'tags_tasks.tag_id', '=', 'tags.id')
            ->where('tags_tasks.task_id', '=', $taskId)
            ->pluck('tag_name')
            ->toArray();
    }
}
