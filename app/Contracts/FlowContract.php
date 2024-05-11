<?php

namespace App\Contracts;

use App\Models\Flow;
use Illuminate\Database\Eloquent\Collection;

interface FlowContract
{
    public function getFlowsByGroup(string $groupId): Collection;

    public function getFlowByTask(string $taskId): Flow;
}
