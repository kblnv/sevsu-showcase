<?php

use Livewire\Volt\Component;
use App\Models\Flow;
use App\Models\TagTask;
use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new #[Title("Банк задач")] class extends Component {
    use WithPagination;

    #[Url]
    public $selectedFlow = "";

    public function tasks()
    {
        $user = auth()->user();

        $tasks = Task::select(
            "tasks.id",
            "tasks.task_name",
            "tasks.task_description",
            "tasks.customer",
            "tasks.max_projects",
        )
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->where("flows.flow_name", "=", $this->selectedFlow)
            ->join("groups_flows", "flows.id", "=", "groups_flows.flow_id")
            ->where("groups_flows.group_id", $user->group_id)
            ->join("groups", "groups_flows.group_id", "=", "groups.id")
            ->paginate(10);

        return $tasks;
    }

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        $user = auth()->user();

        $flows = Flow::select(
            "flows.id",
            "flows.flow_name",
            "flows.take_before",
            "flows.finish_before",
            "flows.max_team_size",
            "flows.can_create_task",
        )
            ->join("groups_flows", "flows.id", "=", "groups_flows.flow_id")
            ->where("groups_flows.group_id", $user->group_id)
            ->get();

        return $flows;
    }

    public function tags($taskId)
    {
        $tags = TagTask::select("tags.tag_name")
            ->join("tags", "tags_tasks.tag_id", "=", "tags.id")
            ->where("tags_tasks.task_id", "=", $taskId)
            ->pluck("tag_name")
            ->toArray();

        return $tags;
    }

    public function mount()
    {
        if (
            $this->selectedFlow == "" ||
            ! $this->flows()->firstWhere("flow_name", $this->selectedFlow)
        ) {
            $this->selectedFlow = $this->flows()->first()->flow_name ?? "";
        }
    }

    public function paginationView()
    {
        return "components.widgets.pagination";
    }
}; ?>

<div>
    @if ($selectedFlow == "")
        <x-shared.page-heading>
            Вы не прикреплены ни к одной дисциплине
        </x-shared.page-heading>
    @else
        <x-shared.select
            id="flow"
            label="Выберите дисциплину для отображения:"
            wire:model.live="selectedFlow"
            wire:change="setPage(1)"
        >
            <option value="" disabled>Дисциплина</option>
            @foreach ($this->flows as $flow)
                @if ($flow->flow_name == $selectedFlow)
                    <option value="{{ $flow->flow_name }}" selected>
                        {{ $flow->flow_name }}
                    </option>
                @else
                    <option value="{{ $flow->flow_name }}">
                        {{ $flow->flow_name }}
                    </option>
                @endif
            @endforeach
        </x-shared.select>

        @if ($this->tasks()->count() == 0)
            <x-shared.page-heading class="mt-8">
                Нет задач по выбранной дисциплине
            </x-shared.page-heading>
        @else
            <x-shared.page-heading class="mt-8">
                Банк задач по выбранной дисциплине:
            </x-shared.page-heading>

            <div class="mt-4 space-y-8">
                @foreach ($this->tasks()->items() as $task)
                    <x-entities.task-card
                        :title="$task['task_name']"
                        :customer="$task['customer']"
                        :description="$task['task_description']"
                        :takeBefore="$this->flows->firstWhere('flow_name', $selectedFlow)['take_before']"
                        :finishBefore="$this->flows->firstWhere('flow_name', $selectedFlow)['finish_before']"
                        :maxTeamMembers="$this->flows->firstWhere('flow_name', $selectedFlow)['max_team_size']"
                        :maxTeams="$task['max_projects']"
                        :tags="$this->tags($task['id'])"
                    />
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $this->tasks()->links() }}
        </div>
    @endif
</div>
