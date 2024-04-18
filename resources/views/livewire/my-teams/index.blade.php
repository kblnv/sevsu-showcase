<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Facades\Teams;
use App\Facades\Tags;

new #[Title("Мои команды")] class extends Component {
    use WithPagination;

    #[Computed(persist: true, seconds: 300)]
    public function teams()
    {
        return Teams::getUserTeamsByUser(auth()->user()->id);
    }

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
    }

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }

    public function paginationView()
    {
        return "components.widgets.pagination";
    }
};
?>

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
