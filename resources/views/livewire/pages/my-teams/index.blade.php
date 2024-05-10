<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Facades\Teams;
use App\Facades\Tags;
use App\Traits\CustomPagination;

new #[Title("Мои команды")] class extends Component {
    use CustomPagination;

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
};
?>

<div>
    @if ($this->teams()->count() == 0)
        <x-ui.page-heading>Вы не состоите ни в одной команде</x-ui.page-heading>
    @else
        <x-ui.page-heading>
            Все команды, в которых Вы состоите:
        </x-ui.page-heading>
        <div class="mt-4 space-y-8">
            @foreach ($this->teams()->items() as $team)
                <x-components.team-card
                    :team="$team"
                    :maxTeamMembers="$team['max_team_size']"
                    :flow="$team['flow_name']"
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
