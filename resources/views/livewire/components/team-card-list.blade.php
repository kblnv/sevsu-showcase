<?php

use App\Facades\Tags;
use App\Facades\Teams;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public $teams;
    public $flow;

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
    }

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }
}; ?>

<div class="mt-4 space-y-8">
    @foreach ($teams as $team)
        @if ($flow)
            <!-- Если передан объект $flow показываем команды по выбранной дисциплине -->
            <x-team-card
                :team="$team"
                :maxTeamMembers="$flow['max_team_size']"
                :tags="$this->tags($team['task_id'])"
                :members="$this->members($team['id'])"
            />
        @else
            <!-- Иначе показываем команды пользователя -->
            <x-team-card
                :team="$team"
                :maxTeamMembers="$team['max_team_size']"
                :flow="$team['flow_name']"
                :tags="$this->tags($team['task_id'])"
                :members="$this->members($team['id'])"
            />
        @endif
    @endforeach
</div>
