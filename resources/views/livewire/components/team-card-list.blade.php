<?php

use App\Facades\Tags;
use App\Facades\Teams;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public $teams;
    public $maxTeamMembers;

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
    }

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }

}; ?>

<div>
    <div class="mt-4 space-y-8">
        @foreach ($teams as $team)
            <x-team-card
                :team="$team"
                :maxTeamMembers="$maxTeamMembers"
                :tags="$this->tags($team['task_id'])"
                :members="$this->members($team['id'])"
            />
        @endforeach
    </div>
</div>

