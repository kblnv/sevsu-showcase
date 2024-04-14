<?php

use App\Models\TagTask;
use App\Models\Team;
use App\Models\UserTeam;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

new #[Title("Мои команды")] class extends Component {
    use WithPagination;

    #[Computed(persist: true, seconds: 300)]
    public function teams()
    {
        $user = auth()->user();

        $teams = Team::select(
            "flows.id",
            "flows.flow_name",
            "flows.max_team_size",
            "teams.id",
            "teams.team_name",
            "teams.team_description",
            "teams.task_id",
            "tasks.task_name",
            "tasks.task_description",
            "tasks.max_projects",
        )
            ->join("tasks", "teams.task_id", "=", "tasks.id")
            ->join("flows", "tasks.flow_id", "=", "flows.id")
            ->join("groups_flows", "flows.id", "=", "groups_flows.flow_id")
            ->join("users", "users.group_id", "=", "groups_flows.group_id")
            ->where("users.id", $user->id)
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

    public function paginationView()
    {
        return "components.widgets.pagination";
    }
}; ?>

<div>
    @if ($this->teams()->count() == 0)
        <x-shared.page-heading>
            Вы не состоите ни в одной команде
        </x-shared.page-heading>
    @else
        <x-shared.page-heading>
            Все команды, в которых Вы состоите:
        </x-shared.page-heading>
        <div class="mt-4 space-y-8">
            @foreach ($this->teams()->items() as $team)
                <x-entities.team-card
                    :title="$team['team_name']"
                    :flow="$team['flow_name']"
                    :task="$team['task_name']"
                    :description="$team['team_description']"
                    :maxTeamMembers="$team['max_team_size']"
                    :tags="$this->tags($team['task_id'])"
                    :members="$this->members($team['id'])"
                />
            @endforeach
        </div>

        <div class="mt-4">
            {{ $this->teams()->links() }}
        </div>
    @endif
</div>
