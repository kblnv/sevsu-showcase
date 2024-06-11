<?php

use App\Models\Flow;
use App\Models\Task;
use App\Models\Team;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

new #[Title("Задача")] class extends Component {
    public ?Team $team = null;
    public ?Task $task = null;
    public ?Flow $flow = null;

    #[Url]
    public string $currentTab = "";
    public string $defaultTab = "Команда";
    public array $tabs = ["Команда", "Участники"];

    public function switchTab(string $tabName): void
    {
        $this->currentTab = $tabName;
    }

    public function mount(Team $team): void
    {
        $this->team = $team;
        $this->task = Task::find($team["task_id"]);
        $this->flow = Flow::find($this->task["flow_id"]);

        if (
            $this->currentTab === "" ||
            ! in_array($this->currentTab, $this->tabs)
        ) {
            $this->currentTab = $this->defaultTab;
        }
    }
};
?>

<div>
    <x-page.button href="{{ route('tasks.index') }}" arrow="back" wire:navigate>
        Назад
    </x-page.button>

    <div class="mt-8">
        <livewire:components.tabs :tabs="$tabs" :currentTab="$currentTab" />
    </div>

    <div
        class="flex flex-col gap-2 overflow-hidden border border-t-0 border-gray-300 bg-sevsu-white px-6 py-4"
    >
        @if ($currentTab === "Команда")
            <section>
                <x-page.heading>Информация о команде</x-page.heading>
                <x-description-list.root>
                    <x-description-list.item
                        term="Название команды"
                        :description="$team['team_name']"
                    />
                    @if ($team["description"])
                        <x-description-list.item
                            term="Описание команды"
                            :description="$team['description']"
                        />
                    @endif

                    <x-description-list.item
                        term="Задача"
                        :link="route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']])"
                        :description="$task['task_name']"
                    />
                </x-description-list.root>

                <x-button>Вступить в команду</x-button>
            </section>
        @elseif ($currentTab === "Участники")
            <section>
                <x-page.heading>Участники команды</x-page.heading>
            </section>
        @endif
    </div>
</div>
