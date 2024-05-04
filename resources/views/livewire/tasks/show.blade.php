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
                    class="text-md inline-flex items-center font-medium transition-colors hover:text-sevsu-blue"
                    href="{{ route("tasks.index") }}"
                    wire:navigate
                >
                    Банк задач
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg
                        class="mx-1 h-3 w-3 text-gray-400 rtl:rotate-180"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 6 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 9 4-4-4-4"
                        />
                    </svg>
                    <span
                        class="text-md ms-1 font-medium text-gray-500 md:ms-2"
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
            <x-shared.arrow-down class="size-6" stroke-width="2" />
            <x-shared.page-heading>Информация о задаче</x-shared.page-heading>
        </button>
        <dl
            class="max-w-xl space-y-2"
            x-show="showInfo"
            x-collapse.duration.350ms
        >
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">Дисциплина</dt>
                <dd class="font-myriad-semibold text-lg">{{ $flow }}</dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">Название задачи</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $title }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">Заказчик</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $customer }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">Описание задачи</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $description }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">Взять задачу до</dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $takeBefore }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Завершить задачу до
                </dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $finishBefore }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Максимум человек в команде
                </dt>
                <dd class="font-myriad-semibold text-lg">
                    {{ $maxTeamSize }}
                </dd>
            </div>
            <div
                class="flex flex-col border-b border-gray-200 py-2 first:pb-2 first:pt-4"
            >
                <dt class="mb-1 text-slate-600 md:text-lg">
                    Максимальное количество команд
                </dt>
                <dd class="font-myriad-semibold text-lg">
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
            <x-shared.arrow-down class="size-6" stroke-width="2" />
            <x-shared.page-heading>
                Команды, выбравшие данную задачу
            </x-shared.page-heading>
        </button>
    </div>
</div>
