<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Flow;
use App\Models\Task;

new #[Title("Задача")] class extends Component {
    public $flow;
    public $takeBefore;
    public $finishBefore;
    public $maxTeamSize;
    public $title;
    public $description;
    public $customer;
    public $maxProjects;

    public function mount(Flow $flow, Task $task)
    {
        $this->flow = $flow["flow_name"];
        $this->takeBefore = $flow["take_before"];
        $this->finishBefore = $flow["finish_before"];
        $this->maxTeamSize = $flow["max_team_size"];

        $this->title = $task["task_name"];
        $this->description = $task["task_description"];
        $this->customer = $task["customer"];
        $this->maxProjects = $task["max_projects"];
    }
};
?>

<div>
    <div x-data="{ showInfo: true }">
        <button type="button" class="flex items-center gap-2" @click="showInfo = !showInfo">
            <x-shared.arrow-down class="size-6" stroke-width="2" />
            <x-shared.page-heading>
                Информация о задаче
            </x-shared.page-heading>
        </button>
        <dl
            class="max-w-md space-y-2"
            x-show="showInfo"
            x-collapse.duration.350ms
        >
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">Дисциплина</dt>
                <dd class="font-myriad-semibold text-lg">{{ $flow }}</dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">Название задачи</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $title }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">Заказчик</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $customer }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">Описание задачи</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $description }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">Взять задачу до</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $takeBefore }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Завершить задачу до
                </dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $finishBefore }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Максимум человек в команде
                </dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $maxTeamSize }}
                </dd>
            </div>
            <div class="flex flex-col border-b border-gray-200 py-2">
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Максимальное количество команд
                </dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $maxProjects }}
                </dd>
            </div>
        </dl>
    </div>

    <div x-data="{ showTeams: true }" class="mt-4">
        <button type="button" class="flex items-center gap-2" @click="showTeams = !showTeams">
            <x-shared.arrow-down class="size-6" stroke-width="2"/>
            <x-shared.page-heading>
                Команды, выбравшие данный проект
            </x-shared.page-heading>
        </button>
    </div>
</div>
