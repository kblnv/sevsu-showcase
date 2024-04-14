<?php

use Livewire\Volt\Component;
use App\Models\Flow;
use App\Models\TagTask;
use App\Models\Team;
use App\Models\UserTeam;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

new #[Title("Команды")] class extends Component {
    use WithPagination;

    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        $user = auth()->user();

        $flows = Flow::select(
            "flows.id",
            "flows.flow_name",
            "flows.max_team_size",
        )
            ->join("groups_flows", "flows.id", "=", "groups_flows.flow_id")
            ->where("groups_flows.group_id", $user->group_id)
            ->get();

        return $flows;
    }

    public function teams()
    {
        $teams = Team::select(
            "teams.id",
            "teams.team_name",
            "teams.team_description",
            "teams.task_id",
            "tasks.task_name",
            "tasks.task_description",
        )
            ->join("tasks", "teams.task_id", "=", "tasks.id")
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->where("flows.flow_name", "=", $this->selectedFlow)
            ->paginate(10);

        return $teams;
    }

    public function members($teamId)
    {
        $members = UserTeam::select(
            "users.first_name",
            "users.second_name",
            "users.last_name",
            "users_teams.is_moderator",
            "vacancies.vacancy_name",
        )
            ->join("users", "users_teams.user_id", "=", "users.id")
            ->join("teams", "teams.id", "=", "users_teams.team_id")
            ->where("teams.id", "=", $teamId)
            ->join("vacancies", "users.id", "=", "vacancies.user_id")
            ->where("vacancies.team_id", "=", $teamId)
            ->get()
            ->toArray();

        return $members;
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

        @if ($this->flows->count() == 0)
            <x-shared.page-heading class="mt-8">
                Нет команд по выбранной дисциплине
            </x-shared.page-heading>
        @else
            <x-shared.page-heading class="mt-8">
                Команды по выбранной дисциплине:
            </x-shared.page-heading>

            <div class="mt-4 space-y-8">
                @foreach ($this->teams()->items() as $team)
                    <x-entities.team-card
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
