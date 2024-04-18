<?php

namespace App\Contracts;

interface TaskContract {
    public function getTasksByFlow($selectedFlow, $groupId, $paginateCount);
    public function getTaskByFlow($taskId, $flowId);
}
