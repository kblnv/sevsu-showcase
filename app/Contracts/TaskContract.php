<?php

namespace App\Contracts;

interface TaskContract {
    public function getFlowTasksByGroupId($selectedFlow, $groupId, $paginateCount);
}
