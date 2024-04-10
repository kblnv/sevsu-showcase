<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Банк задач')]
class TasksPage extends Component
{
    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        $user = auth()->user();

        $tasks = Task::select(
                'flows.flow_name',
                'flows.start_team',
                'flows.end_team',
                'flows.team_size',
                'flows.can_create_task',
                'tasks.task_name',
                'tasks.description',
                'tasks.customer',
                'tasks.max_project'
            )
            ->join('flows', 'tasks.flow_id', '=', 'flows.id')
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $user->group_id)
            ->join('groups', 'groups_flows.group_id', '=', 'groups.id')
            ->join('users', 'groups.id', '=', 'users.group_id')
            ->where('users.id', $user->id)
            ->get();

        $data = [];

        if ($tasks->isNotEmpty()) {
            foreach ($tasks as $task) {
                if (empty($data[$task->flow_name])) {
                    $data[$task->flow_name] = [
                        'takeBefore' => $task->start_team,
                        'finishBefore' => $task->end_team,
                        'maxTeamMembers' => $task->team_size,
                        'canCreateTask' => $task->can_create_task,
                        'tasks' => [],
                    ];
                }

                $data[$task->flow_name]['tasks'][] = [
                    'title' => $task->task_name,
                    'description' => $task->description,
                    'customer' => $task->customer,
                    'maxTeams' => $task->max_project,
                ];
            }
        }

        return $data;
    }

    public function mount()
    {
        if ($this->selectedFlow == "" || !array_key_exists($this->selectedFlow, $this->flows)) {
            $this->selectedFlow = array_keys($this->flows)[0];
        }
    }

    public function render()
    {
        return view('tasks-page', [
            "flowsNames" => array_keys($this->flows)
        ]);
    }
}
