<?php

use App\Facades\Teams;
use App\Models\Flow;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new #[Title("Задача")] class extends Component {
    public ?Team $team = null;
    public ?Task $task = null;
    public ?Flow $flow = null;
    public ?array $members = null;
    public ?array $vacancies = null;

    public ?bool $canCreateTeam = null;
    public ?bool $isModerator = null;

    public bool $modalTeamChange = false;

    public function showModalTeamChange() {
        $this->modalTeamChange = true;
    }

    public function closeModalTeamChange() {
        $this->modalTeamChange = false;
    }

    public function switchTab(string $tabName): void
    {
        $this->currentTab = $tabName;
    }

    public function mount(Team $team): void
    {
        $this->team = $team;
        $this->task = Task::find($team["task_id"]);
        $this->flow = Flow::find($this->task["flow_id"]);
        $this->members = Teams::getMembersByTeam($team["id"]);
        $this->vacancies = Teams::getTeamVacancies($team["id"]);
        
        $this->canCreateTeam = Teams::canCreateTeam(
            $this->task["id"],
            Auth::id(),
        );

        $this->isModerator = Teams::isModerator($team["id"], Auth::id());
    }
};
?>

<div>
    <x-page.button href="{{ route('teams.index') }}" arrow="back">
        Назад
    </x-page.button>

    <div
        class="mt-8 flex flex-col gap-2 overflow-hidden border border-gray-300 bg-sevsu-white px-6 py-4"
    >
        <section>
            <div class="flex justify-between items-end">
                <x-page.heading class="mr-auto">Информация о команде</x-page.heading>
                @if ($isModerator)
                    <x-button element="button" variant="blue" wire:click="showModalTeamChange">
                        Изменить
                    </x-button>
                @endif
            </div>
            <x-description-list.root>
                <x-description-list.item
                    term="Название команды"
                    :description="$team['team_name']"
                />
                @if ($team["team_description"] != "")
                    <x-description-list.item
                        term="Описание команды"
                        :description="$team['team_description']"
                    />
                @endif

                <x-description-list.item
                    term="Задача"
                    :link="route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']])"
                    :description="$task['task_name']"
                />

                @if ($isModerator)
                    <x-description-list.item
                        term="Пароль"
                        :description="$team['password']"
                    />
                @endif
            </x-description-list.root>

            @if ($canCreateTeam)
                <x-button>Вступить в команду</x-button>
            @endif
        </section>
        <section class="mt-6">
            <x-page.heading>Участники команды</x-page.heading>
            <div
                class="mt-6 overflow-x-auto rounded-lg border border-gray-300 text-sm shadow-sm shadow-gray-300"
                x-cloak
            >
            <x-team.table
                :members="$members"
                :maxTeamMembers="$this->flow['max_team_size']"
            />
            </div>
        </section>
        @if ($isModerator)
            <section class="mt-6">                
                <x-page.heading>Вакансии</x-page.heading>
                    @if ($vacancies != [])
                    <div class="mt-6">
                        <ul
                            class="overflow-hidden rounded border border-gray-300 shadow-sm shadow-gray-300"
                        >
                            @foreach ($vacancies as $vacancy)
                                <li
                                    class="border-b border-gray-200 bg-white px-4 py-2 transition-all duration-300 ease-in-out last:border-none hover:bg-sky-100 hover:text-sky-900"
                                >
                                    {{ $vacancy["vacancy_name"] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div>Вакансий нет</div>
            </section>
        @endif

        @if ($modalTeamChange)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Изменение данных о команде</h2>
                <livewire:components.team-form :isChanging="true" :team="$team"/>
                <div class="mt-6 flex justify-end">
                    <button class="text-gray-600 hover:text-gray-800 mr-4" wire:click="closeModalTeamChange">Отмена</button>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" wire:click="closeModalTeamChange">Сохранить</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
