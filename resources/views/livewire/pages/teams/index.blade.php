<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Facades\Teams;
use App\Facades\Tags;
use App\Facades\Flows;
use App\Traits\CustomPagination;

new #[Title("Команды")] class extends Component {
    use CustomPagination;

    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return Flows::getFlowsByGroup(auth()->user()->group_id);
    }

    public function teams()
    {
        return Teams::getTeamsByFlow($this->selectedFlow);
    }

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
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
};
?>

<div>
    @if ($selectedFlow == "")
        <x-ui.page-heading>
            Вы не прикреплены ни к одной дисциплине
        </x-ui.page-heading>
    @else
        <x-ui.select
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
        </x-ui.select>

        @if ($this->flows->count() == 0)
            <x-ui.page-heading class="mt-8">
                Нет команд по выбранной дисциплине
            </x-ui.page-heading>
        @else
            <x-ui.page-heading class="mt-8">
                Команды по выбранной дисциплине:
            </x-ui.page-heading>

            <div class="mt-4 space-y-8">
                @foreach ($this->teams()->items() as $team)
                    <x-components.team-card
                        :title="$team['team_name']"
                        :task="$team['task_name']"
                        :description="$team['team_description']"
                        :maxTeamMembers="$this->flows->firstWhere('flow_name', $selectedFlow)['max_team_size']"
                        :tags="$this->tags($team['task_id'])"
                        :members="$this->members($team['id'])"
                    />
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $this->teams()->links() }}
        </div>
    @endif
</div>
