<?php

use App\Facades\Tags;
use App\Facades\Teams;
use App\Models\Flow;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public array $teams = [];
    public ?Flow $flow;

    public function getTeamMembers(string $teamId): array
    {
        return Teams::getMembersByTeam($teamId);
    }
}; ?>

<div class="mt-4 space-y-8">
    @foreach ($teams as $team)
        @if ($flow)
            <!-- Если передан объект $flow показываем команды по выбранной дисциплине -->
            <x-team.card
                :team="$team"
                :maxTeamMembers="$flow['max_team_size']"
                :members="$this->getTeamMembers($team['id'])"
            />
        @else
            <!-- Иначе показываем команды пользователя -->
            <x-team.card
                :team="$team"
                :maxTeamMembers="$team['max_team_size']"
                :flow="$team['flow_name']"
                :members="$this->getTeamMembers($team['id'])"
            />
        @endif
    @endforeach
</div>
