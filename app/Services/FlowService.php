<?php

namespace App\Services;

use App\Contracts\FlowContract;
use App\Models\Flow;
use Illuminate\Database\Eloquent\Collection;

class FlowService implements FlowContract
{
    public function getFlowsByGroup(string $groupId): Collection
    {
        return Flow::select(
            'flows.id',
            'flows.flow_name',
            'flows.take_before',
            'flows.finish_before',
            'flows.max_team_size',
            'flows.can_create_task',
        )
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $groupId)
            ->get();
    }
}
