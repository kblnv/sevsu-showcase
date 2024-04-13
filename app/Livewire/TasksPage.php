<?php

namespace App\Livewire;

use App\Models\Flow;
use App\Models\TagTask;
use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Банк задач')]
class TasksPage extends Component
{
    use WithPagination;

    #[Url]
    public $selectedFlow = "";

    public function tasks()
    {
        $user = auth()->user();

        $tasks = Task::select(
                'tasks.id',
                'tasks.task_name',
                'tasks.task_description',
                'tasks.customer',
                'tasks.max_projects'
            )
            ->join('flows', 'tasks.flow_id', '=', 'flows.id')
            ->where('flows.flow_name', '=', $this->selectedFlow)
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $user->group_id)
            ->join('groups', 'groups_flows.group_id', '=', 'groups.id')
            ->join('users', 'groups.id', '=', 'users.group_id')
            ->where('users.id', $user->id)
            ->paginate(10);

        return $tasks;
    }

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        $user = auth()->user();

        $flows = Flow::select(
                'flows.id',
                'flows.flow_name',
                'flows.take_before',
                'flows.finish_before',
                'flows.max_team_size',
                'flows.can_create_task',
            )
            ->join('groups_flows', 'flows.id', '=', 'groups_flows.flow_id')
            ->where('groups_flows.group_id', $user->group_id)
            ->get();

        return $flows;
    }

    public function tags($taskId)
    {
        $tags = TagTask::select('tags.tag_name')
            ->join('tags', 'tags_tasks.tag_id', '=', 'tags.id')
            ->where('tags_tasks.task_id', '=', $taskId)
            ->pluck('tag_name')
            ->toArray();

        return $tags;
    }

    public function mount()
    {
        if ($this->selectedFlow == "" || !$this->flows()->firstWhere('flow_name', $this->selectedFlow)) {
            $this->selectedFlow = $this->flows()->first()->flow_name ?? '';
        }
    }

    public function render()
    {
        return view('livewire.tasks-page');
    }
}
