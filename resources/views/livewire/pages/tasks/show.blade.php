<?php

use App\Facades\Tags;
use App\Facades\Teams;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Flow;
use App\Models\Task;
use Livewire\Attributes\Url;

new #[Title("Задача")] class extends Component {
    public $flow;
    public $task;
    public $teams;
    public $canCreateTeam;

    #[Url]
    public $currentTab = "";
    public $defaultTab = "Задача";
    public $tabs = ["Задача", "Команды", "Создание команды"];

    public function switchTab($tabName)
    {
        $this->currentTab = $tabName;
    }

    public function getTaskTags($taskId)
    {
        return Tags::getTags($taskId);
    }

    public function mount(Flow $flow, Task $task)
    {
        $this->taskId = $task["id"];
        $this->flow = $flow;
        $this->task = $task;
        $this->teams = Teams::getTeamsByTask($task["id"]);
        $this->canCreateTeam = Teams::canCreateTeam($this->taskId, Auth::id());

        if (! $this->canCreateTeam) {
            array_splice($this->tabs, count($this->tabs) - 1, 1);
        }

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
    <x-page.button type="back" href="{{ route('tasks.index') }}" wire:navigate>
        Назад
    </x-page.button>

    <div class="mt-8">
        <livewire:components.tabs :tabs="$tabs" :currentTab="$currentTab" />
    </div>

    <div
        class="flex flex-col gap-2 overflow-hidden border border-t-0 border-gray-300 bg-sevsu-white px-6 py-4"
    >
        @if ($currentTab === "Задача")
            <section>
                <x-page.heading>Информация о задаче</x-page.heading>
                <x-description-list.root>
                    <x-description-list.item
                        term="Дисциплина"
                        :description="$this->flow['flow_name']"
                    />
                    <x-description-list.item
                        term="Название задачи"
                        :description="$this->task['task_name']"
                    />
                    <x-description-list.item term="Тэги">
                        <x-slot:description>
                            <x-card.tags
                                :tags="$this->getTaskTags($this->task['id'])"
                            />
                        </x-slot>
                    </x-description-list.item>
                    <x-description-list.item
                        term="Заказчик"
                        :description="$this->task['customer']"
                    />
                    <x-description-list.item
                        term="Описание задачи"
                        :description="$this->task['task_description']"
                    />
                    <x-description-list.item
                        term="Взять задачу до"
                        :description="$this->flow['take_before']"
                    />
                    <x-description-list.item
                        term="Завершить задачу до"
                        :description="$this->flow['finish_before']"
                    />
                    <x-description-list.item
                        term="Максимум человек в команде"
                        :description="$this->flow['max_team_size']"
                    />
                    <x-description-list.item
                        term="Максимальное количество команд"
                        :description="$this->task['max_projects']"
                    />
                </x-description-list.root>
            </section>
        @elseif ($currentTab === "Команды")
            <section>
                <x-page.heading>
                    Команды, выбравшие данную задачу
                </x-page.heading>
                <div>
                    @if (count($this->teams) === 0)
                        <h2 class="text-md py-6">
                            Нет команд, выбравших эту задачу
                        </h2>
                    @else
                        <div class="space-y-8 py-6">
                            <livewire:components.team-card-list
                                :teams="$teams"
                                :flow="$flow"
                            />
                        </div>
                    @endif
                </div>
            </section>
        @elseif ($currentTab === "Создание команды")
            <section>
                <x-page.heading>Форма создания команды</x-page.heading>
                <livewire:components.team-form :task="$task" :flow="$flow" />
            </section>
        @endif
    </div>
</div>
