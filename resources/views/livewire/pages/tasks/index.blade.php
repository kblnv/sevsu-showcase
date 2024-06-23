<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Facades\Flows;
use App\Facades\Tasks;
use App\Models\Flow;
use App\Traits\WithCustomPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

new #[Title("Банк задач")] class extends Component {
    use WithCustomPagination;

    public $randomArray;

    #[Url]
    public string $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows(): Collection
    {
        return Flows::getFlowsByGroup(auth()->user()->group_id);
    }

    #[Computed]
    public function currentTasks(): LengthAwarePaginator
    {
        return Tasks::getTasksByFlow(
            $this->selectedFlow,
            auth()->user()->group_id,
            10,
        );
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
        $this->randomArray = session('randomArray', []);     
    }
};
?>

<div>
    @if ($selectedFlow == "")
        <x-page.heading>Вы не прикреплены ни к одной дисциплине</x-page.heading>
    @else
    <div class="flex justify-between">
        <div>
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
        </div>
        <div class="bg-gray-100 p-4 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-4">Массив дня:</h1>
            <div class="flex flex-wrap">
                @foreach ($randomArray as $item)
                    <span class="mr-2">{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </div>

        @if ($this->currentTasks->count() == 0)
            <x-page.heading class="mt-8">
                Нет задач по выбранной дисциплине
            </x-page.heading>
        @else
            <x-page.heading class="mt-8">
                Банк задач по выбранной дисциплине:
            </x-page.heading>

            <livewire:components.task-card-list
                :tasks="$this->currentTasks->items()"
                :flow="$this->currentFlow"
            />
        @endif

        <div class="mt-4">
            {{ $this->currentTasks->links() }}
        </div>
    @endif
</div>
