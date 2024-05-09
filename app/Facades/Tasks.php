<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator getTasksByFlow(string $selectedFlow, string $groupId, int $paginateCount)
 * @method static \Illuminate\Database\Eloquent\Collection getTaskByFlow(string $taskId, string $flowId)
 */
class Tasks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tasks';
    }
}
