<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Facades\Teams;
use App\Facades\Flows;
use App\Models\Flow;
use App\Traits\WithCustomPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

new #[Title("Команды")] class extends Component {
    use WithCustomPagination;

    #[Url]
    public string $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows(): Collection
    {
        return Flows::getFlowsByGroup(auth()->user()->group_id);
    }

    #[Computed]
    public function currentTeams(): LengthAwarePaginator
    {
        return Teams::getTeamsByFlow($this->selectedFlow);
    }

    #[Computed]
    public function currentFlow(): ?Flow
    {
        return $this->flows->firstWhere("flow_name", $this->selectedFlow);
    }

    public function mount(): void
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
        <x-page.heading>Вы не прикреплены ни к одной дисциплине</x-page.heading>
    @else
        <x-select
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
        </x-select>

        @if ($this->currentTeams->count() == 0)
            <x-page.heading class="mt-8">
                Нет команд по выбранной дисциплине
            </x-page.heading>
        @else
            <x-page.heading class="mt-8">
                Команды по выбранной дисциплине:
            </x-page.heading>

            <livewire:components.team-card-list
                :teams="$this->currentTeams->items()"
                :flow="$this->currentFlow"
            />
        @endif

        <div class="mt-4">
            {{ $this->currentTeams->links() }}
        </div>
    @endif
</div>