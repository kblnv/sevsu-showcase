<?php

namespace App\Services;
use App\Contracts\TaskContract;
use App\Models\Task;

class TaskService implements TaskContract {
    public function getFlowTasksByGroupId($selectedFlow, $groupId, $paginateCount = 10)
    {
        return Task::select(
            "tasks.id",
            "tasks.task_name",
            "tasks.task_description",
            "tasks.customer",
            "tasks.max_projects",
        )
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->where("flows.flow_name", "=", $selectedFlow)
            ->join("groups_flows", "flows.id", "=", "groups_flows.flow_id")
            ->where("groups_flows.group_id", $groupId)
            ->join("groups", "groups_flows.group_id", "=", "groups.id")
            ->paginate($paginateCount);
    }
}
