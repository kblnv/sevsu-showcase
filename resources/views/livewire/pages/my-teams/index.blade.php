<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Facades\Teams;
use App\Facades\Tags;
use App\Traits\WithCustomPagination;

new #[Title("Мои команды")] class extends Component {
    use WithCustomPagination;

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
        <x-page-heading>Вы не состоите ни в одной команде</x-page-heading>
    @else
        <x-page-heading>Все команды, в которых Вы состоите:</x-page-heading>

        <livewire:components.team-card-list :teams="$this->teams()->items()" />

        <div class="mt-4">
            {{ $this->teams()->links() }}
        </div>
    @endif
</div>
