<?php

namespace App\Services;

use App\Contracts\TaskContract;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskContract
{
    public function getTasksByFlow(string $flowName, string $groupId, int $paginateCount = 10): LengthAwarePaginator
    {
        return Task::select(
            'tasks.id',
            'tasks.task_name',
            'tasks.task_description',
            'tasks.customer',
            'tasks.max_projects',
        )
            ->selectSub($this->getTeamCountSubquery(), 'team_count')
            ->join('flows', 'tasks.flow_id', '=', 'flows.id')
            ->where('flows.flow_name', '=', $flowName)
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $groupId)
            ->join('groups', 'groups_flows.group_id', '=', 'groups.id')
            ->paginate($paginateCount);
    }

    public function getTaskByFlow(string $taskId, string $flowId): Collection
    {
        return Task::select(
            'tasks.id',
            'tasks.task_name',
            'tasks.task_description',
            'tasks.customer',
            'tasks.max_projects',
            'flows.take_before',
            'flows.finish_before',
            'flows.max_team_size',
        )
            ->join('flows', 'tasks.flow_id', '=', 'flows.id')
            ->where('flows.id', '=', $flowId)
            ->where('tasks.id', '=', $taskId)
            ->get();
    }

    public function getRemainingTeamsCount(string $taskId): int
    {
        $maxTeams = Task::where('id', '=', $taskId)
            ->value('max_projects');

        $teamsCount = Team::where('task_id', '=', $taskId)
            ->count();

        return $maxTeams - $teamsCount;
    }

    private function getTeamCountSubquery()
    {
        return Team::selectRaw('COUNT(*)')
            ->whereRaw('teams.task_id = tasks.id');
    }
}
