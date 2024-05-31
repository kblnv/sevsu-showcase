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
    public $availableTabs = ["Задача", "Команды", "Создание команды"];

    public function selectTab($tabName)
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

        if ($this->currentTab === "" || !in_array($this->currentTab, $this->availableTabs) || ($this->currentTab === "Создание команды" && !$this->canCreateTeam)) {
            $this->currentTab = "Задача";
        }
    }
};
?>

<div>
    <x-page.button type="back" href="{{ route('tasks.index') }}" wire:navigate>
        Назад
    </x-page.button>

    <div class="mt-8">
        <div class="sm:hidden">
            <label class="sr-only" for="Tab">Tab</label>

            <select class="w-full rounded-md border-gray-200" id="Tab">
                <option select>Задача</option>
                <option>Команды</option>
                <option>Создать команду</option>
            </select>
        </div>

        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex gap-6">
                    <button
                        :class="$wire.currentTab === 'Задача' ? 'shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sevsu-blue' : 'shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700'"
                        wire:click="selectTab('Задача')"
                    >
                        Задача
                    </button>

                    <button
                        :class="$wire.currentTab === 'Команды' ? 'shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sevsu-blue' : 'shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700'"
                        wire:click="selectTab('Команды')"
                    >
                        Команды
                    </button>

                    @if ($canCreateTeam)
                        <button
                            :class="$wire.currentTab === 'Создание команды' ? 'shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sevsu-blue' : 'shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700'"
                            wire:click="selectTab('Создание команды')"
                        >
                            Создать команду
                        </button>
                     @endif
                </nav>
            </div>
        </div>
    </div>

    <div
        class="flex flex-col gap-2 overflow-hidden border border-t-0 border-gray-300 bg-sevsu-white px-6 py-4"
    >
        <section x-show="$wire.currentTab === 'Задача'">
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

        <section x-show="$wire.currentTab === 'Команды'">
            <x-page.heading>Команды, выбравшие данную задачу</x-page.heading>
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

        @if ($this->canCreateTeam)
            <section x-show="$wire.currentTab === 'Создание команды'">
                <x-page.heading>Форма создания команды</x-page.heading>
                <livewire:components.team-form :task="$task" :flow="$flow" />
            </section>
        @endif
    </div>
</div>
