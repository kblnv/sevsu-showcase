<?php

namespace App\Livewire;

use App\Models\TagTask;
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
                'flows.take_before',
                'flows.finish_before',
                'flows.max_team_size',
                'flows.can_create_task',
                'tasks.id',
                'tasks.task_name',
                'tasks.task_description',
                'tasks.customer',
                'tasks.max_projects'
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
                        'takeBefore' => $task->take_before,
                        'finishBefore' => $task->finish_before,
                        'maxTeamMembers' => $task->max_team_size,
                        'canCreateTask' => $task->can_create_task,
                        'tasks' => [],
                    ];
                }

                $tags = TagTask::select('tags.tag_name')
                    ->join('tags', 'tags_tasks.tag_id', '=', 'tags.id')
                    ->where('tags_tasks.task_id', '=', $task->id)
                    ->pluck('tag_name')
                    ->toArray();

                $data[$task->flow_name]['tasks'][] = [
                    'title' => $task->task_name,
                    'description' => $task->task_description,
                    'customer' => $task->customer,
                    'maxTeams' => $task->max_projects,
                    'tags' => $tags,
                ];
            }
        }

        return $data;
    }

    public function mount()
    {
        if ($this->selectedFlow == "" || !array_key_exists($this->selectedFlow, $this->flows)) {
            $this->selectedFlow = array_keys($this->flows)[0] ?? "";
        }
    }

    public function render()
    {
        return view('tasks-page', [
            "flowsNames" => array_keys($this->flows)
        ]);
    }
}
