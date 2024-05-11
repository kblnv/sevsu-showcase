<?php

use App\Facades\Tags;
use App\Facades\Teams;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Flow;
use App\Models\Task;

new #[Title("Задача")] class extends Component {
    public $flow;
    public $task;
    public $taskTeams;
    public $teamName;
    public $teamDescription;
    public $password;

    public function rules()
    {
        return [
            'teamName' => [
                'required',
                'string',
                'min:5',
                'unique_team_flow:'.$this->task['id'],
            ],
            'teamDescription' => 'nullable|string|min:10',
            'password' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'teamName.unique_team_flow' => 'Команда с таким именем уже существует внутри потока задачи.',
        ];
    }

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }

    public function members($teamId)
    {
        return Teams::getMembersByTeam($teamId);
    }

    public function createTeam()
    {
        $this->validate();

        Teams::createTeam(
            $this->teamName,
            $this->task['id'],
            $this->teamDescription,
            $this->password,
        );

        return $this->redirectRoute("my-teams.index");
    }

    public function mount(Flow $flow, Task $task)
    {
        $this->taskId = $task["id"];
        $this->flow = $flow;
        $this->task = $task;
        $this->taskTeams = Teams::getTeamsByTask($task["id"]);
    }
};
?>

<div>
    @php
    $breadcrumbsItems = [
        ["title" => "Банк задач", "link" => route("tasks.index"), "currentPage" => false],
        ["title" => "Страница задачи", "link" => "", "currentPage" => true],
    ];
    @endphp

    <x-breadcrumbs :items="$breadcrumbsItems" />
    <div
        class="mt-4 flex flex-col gap-2 overflow-hidden rounded-lg border border-gray-300 bg-sevsu-white px-6 py-4"
    >
        <x-task-page-section sectionTitle="Информация о задаче">
            <dl class="divide-y divide-gray-100">
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
                        <x-card.tags :tags="$this->tags($this->task['id'])" />
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
        </x-task-page-section>

        <x-task-page-section sectionTitle="Команды, выбравшие данную задачу">
            <div>
                @if (count($this->taskTeams) === 0)
                    <h2 class="text-md py-6">
                        Нет команд, выбравших эту задачу
                    </h2>
                @else
                    <div class="space-y-8 py-6">
                        @foreach ($this->taskTeams as $team)
                            <x-team-card
                                :team="$team"
                                :maxTeamMembers="$this->flow['max_team_size']"
                                :tags="$this->tags($team['task_id'])"
                                :members="$this->members($team['id'])"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        </x-task-page-section>

        <x-task-page-section sectionTitle="Форма создания команды">
            <form class="flex flex-col gap-4 py-6" wire:submit="createTeam">
                <div>
                    <label
                        class="text-md block font-medium leading-6 text-gray-700"
                        for="team-name"
                    >
                        Название команды *
                    </label>
                    <x-input id="team-name" wire:model="teamName" required />
                </div>

                <div>
                    <label
                        class="text-md block font-medium leading-6 text-gray-700"
                        for="team-description"
                    >
                        Описание команды
                    </label>
                    <textarea
                        class="w-full rounded-lg border-2 border-gray-300 bg-sevsu-light-gray p-3 outline-none focus:border-sevsu-blue"
                        id="team-description"
                        rows="3"
                        wire:model="teamDescription"
                    ></textarea>
                </div>

                <div>
                    <label
                        class="text-md block font-medium leading-6 text-gray-700"
                        for="password"
                    >
                        Пароль
                    </label>
                    <x-input
                        id="password"
                        type="password"
                        wire:model="password"
                    />
                </div>
                <div class="mt-4">
                    <button
                        class="leading inline-flex items-center rounded-md border border-transparent bg-sevsu-blue px-4 py-2 text-sm font-medium text-white"
                        type="submit"
                    >
                        Создать команду
                    </button>
                </div>
            </form>
        </x-task-page-section>
    </div>
</div>
