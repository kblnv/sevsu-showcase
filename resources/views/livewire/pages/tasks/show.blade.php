<?php

use App\Facades\Tags;
use App\Facades\Teams;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Flow;
use App\Models\Task;

new #[Title("Задача")] class extends Component {
    private $flow;
    private $task;
    private $taskTeams;

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
    }

    public function mount(Flow $flow, Task $task)
    {
        $this->flow = $flow;
        $this->task = $task;
        $this->taskTeams = Teams::getTeamsByTask($task["id"]);
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
                    <x-ui.arrow-up
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
    <div
        class="mt-4 overflow-hidden rounded-lg border border-gray-300 bg-sevsu-white px-6 py-4"
    >
        <div x-data="{ showInfo: true }">
            <button
                class="flex items-center gap-2"
                type="button"
                @click="showInfo = !showInfo"
            >
                <div class="size-5">
                    <x-ui.arrow-up x-show="showInfo" />
                    <x-ui.arrow-down x-show="!showInfo" x-cloak />
                </div>
                <x-ui.page-heading>
                    Информация о задаче
                </x-ui.page-heading>
            </button>
            <dl class="divide-y divide-gray-100" x-show="showInfo">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Дисциплина</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->flow["flow_name"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Название задачи</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->task["task_name"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Тэги</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        <x-ui.card.tags :tags="$this->tags($this->task['id'])" />
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Заказчик</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->task["customer"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Описание задачи</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->task["task_description"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Взять задачу до</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->flow["take_before"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">Завершить задачу до</dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->flow["finish_before"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">
                        Максимум человек в команде
                    </dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->flow["max_team_size"] }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-md leading-6">
                        Максимальное количество команд
                    </dt>
                    <dd
                        class="text-md mt-1 leading-6 text-gray-500 sm:col-span-2 sm:mt-0"
                    >
                        {{ $this->task["max_projects"] }}
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
                    <x-ui.arrow-up x-show="showTeams" />
                    <x-ui.arrow-down x-show="!showTeams" x-cloak />
                </div>
                <x-ui.page-heading>
                    Команды, выбравшие данную задачу
                </x-ui.page-heading>
            </button>

            <div x-show="showTeams">
                @if (count($this->taskTeams) === 0)
                    <h2 class="text-md py-6">
                        Нет команд, выбравших эту задачу
                    </h2>
                @else
                    <div class="space-y-8 py-6">
                        @foreach ($this->taskTeams as $team)
                            <x-components.team-card
                                :team="$team"
                                :maxTeamMembers="$this->flow['max_team_size']"
                                :tags="$this->tags($team['task_id'])"
                                :members="$this->members($team['id'])"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4" x-data="{ showForm: true }">
            <button
                class="flex items-center gap-2"
                type="button"
                @click="showForm = !showForm"
            >
                <div class="size-5">
                    <x-ui.arrow-up x-show="showForm" />
                    <x-ui.arrow-down x-show="!showForm" x-cloak />
                </div>
                <x-ui.page-heading>
                    Форма создания команды
                </x-ui.page-heading>
            </button>

            <div x-show="showForm">
                <form>
                    <div>
                        <span for="team-name" class="block text-md leading-6 font-medium text-gray-700">Название команды</span>
                        <x-ui.input
                            id="team-name"
                        />
                    </div>

                    <div class="mt-4">
                        <span class="block text-md leading-6 font-medium text-gray-700">Описание команды</span>
                        <textarea
                            id="team-description"
                            name="team-description"
                            class="rounded-lg border-2 border-gray-300 p-3 outline-none bg-sevsu-light-gray focus:border-sevsu-blue"
                        >
                        </textarea>
                    </div>

                    <div class="mt-4">
                        <span class="block text-md leading-6 font-medium text-gray-700">Пароль</span>
                        <x-ui.input
                            type="password"
                            id="password"
                        />
                    </div>

                    <div class="mt-4">
                        <span class="block text-md leading-6 font-medium text-gray-700">Подтверждение пароля</span>
                        <x-ui.input
                            type="password"
                            id="confirm-password"
                        />
                    </div>

                    <div class="mt-4">
                        <button 
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm
                                   leading font-medium rounded-md text-white bg-sevsu-blue"
                        >Создать команду
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
