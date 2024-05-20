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
    public function userTeams()
    {
        return Teams::getUserTeamsByUser(auth()->user()->id);
    }
};
?>

<div>
    @if ($this->userTeams->count() == 0)
        <x-page.heading>Вы не состоите ни в одной команде</x-page.heading>
    @else
        <x-page.heading>Все команды, в которых Вы состоите:</x-page.heading>

        <livewire:components.team-card-list
            :teams="$this->userTeams->items()"
        />

        <div class="mt-4">
            {{ $this->userTeams->links() }}
        </div>
    @endif
</div>
