<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Facades\Flows;
use App\Facades\Tasks;
use App\Traits\WithCustomPagination;

new #[Title("Банк задач")] class extends Component {
    use WithCustomPagination;

    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return Flows::getFlowsByGroup(auth()->user()->group_id);
    }

    public function tasks()
    {
        return Tasks::getTasksByFlow(
            $this->selectedFlow,
            auth()->user()->group_id,
            10,
        );
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
};
?>

<div>
    @if ($selectedFlow == "")
        <x-page-heading>Вы не прикреплены ни к одной дисциплине</x-page-heading>
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

        @if ($this->tasks()->count() == 0)
            <x-page-heading class="mt-8">
                Нет задач по выбранной дисциплине
            </x-page-heading>
        @else
            <x-page-heading class="mt-8">
                Банк задач по выбранной дисциплине:
            </x-page-heading>

            <livewire:components.task-card-list
                :tasks="$this->tasks()->items()"
                :flow="$this->flows->firstWhere('flow_name', $selectedFlow)"
            />
        @endif

        <div class="mt-4">
            {{ $this->tasks()->links() }}
        </div>
    @endif
</div>
