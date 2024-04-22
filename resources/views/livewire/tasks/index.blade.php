<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Facades\Flows;
use App\Facades\Tasks;
use App\Facades\Tags;

new #[Title("Банк задач")] class extends Component {
    use WithPagination;

    #[Url]
    public $selectedFlow = "";

    public function tasks()
    {
        return Tasks::getTasksByFlow(
            $this->selectedFlow,
            auth()->user()->group_id,
            10,
        );
    }

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return Flows::getFlowsByGroup(auth()->user()->group_id);
    }

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
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
};
?>

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
                        :task="$task"
                        :flow="$this->flows->firstWhere('flow_name', $selectedFlow)"
                        :title="$task['task_name']"
                        :customer="$task['customer']"
                        :description="$task['task_description']"
                        :flowId="$this->flows->firstWhere('flow_name', $selectedFlow)['id']"
                        :taskId="$task['id']"
                        :takeBefore="$this->flows->firstWhere('flow_name', $selectedFlow)['take_before']"
                        :finishBefore="$this->flows->firstWhere('flow_name', $selectedFlow)['finish_before']"
                        :maxTeamSize="$this->flows->firstWhere('flow_name', $selectedFlow)['max_team_size']"
                        :maxProjects="$task['max_projects']"
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
