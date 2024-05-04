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
    <nav class="flex" aria-label="Breadcrumb">
        <ol
            class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
        >
            <li class="inline-flex items-center">
                <a
                    class="inline-flex items-center font-myriad-regular text-sm transition-colors hover:text-sevsu-blue"
                    href="{{ route("tasks.index") }}"
                    wire:navigate
                >
                    Банк задач
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <x-shared.arrow-up
                        class="h-3 w-3 rotate-90"
                        stroke-width="2"
                    />
                    <span
                        class="ms-1 font-myriad-regular text-sm text-gray-500 md:ms-2"
                    >
                        Страница задачи
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="mt-4" x-data="{ showInfo: true }">
        <button
            class="flex items-center gap-2"
            type="button"
            @click="showInfo = !showInfo"
        >
            <div class="size-5">
                <x-shared.arrow-up x-show="showInfo" />
                <x-shared.arrow-down x-show="!showInfo" x-cloak />
            </div>
            <x-shared.page-heading>Информация о задаче</x-shared.page-heading>
        </button>
        <dl
            class="divide-y divide-gray-100"
            x-show="showInfo"
            x-collapse.duration.350ms
        >
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Дисциплина
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $flow }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Название задачи
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $title }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">Заказчик</dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $customer }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Описание задачи
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $description }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Взять задачу до
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $takeBefore }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Завершить задачу до
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $finishBefore }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Максимум человек в команде
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $maxTeamSize }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="font-myriad-regular text-lg leading-6">
                    Максимальное количество команд
                </dt>
                <dd
                    class="mt-1 text-lg leading-6 text-slate-600 sm:col-span-2 sm:mt-0"
                >
                    {{ $maxProjects }}
                </dd>
            </div>
        </dl>
    </div>

    <div class="mt-4" x-data="{ showTeams: true }">
        <button
            class="flex items-center gap-2"
            type="button"
            @click="showTeams = !showTeams"
        >
            <div class="size-5">
                <x-shared.arrow-up x-show="showTeams" />
                <x-shared.arrow-down x-show="!showTeams" x-cloak />
            </div>
            <x-shared.page-heading>
                Команды, выбравшие данную задачу
            </x-shared.page-heading>
        </button>
    </div>
</div>
