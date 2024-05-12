<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TaskContract
{
    public function getTasksByFlow(string $selectedFlow, string $groupId, int $paginateCount): LengthAwarePaginator;

    public function getTaskByFlow(string $taskId, string $flowId): Collection;

    public function getRemainingTeamsCount(string $taskId): int;
}
