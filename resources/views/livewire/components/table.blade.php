<?php

use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public array $members =[];
    public int $maxTeamMembers;

    public ?bool $isModerator = null;
    public ?array $vacancies = null;

    public bool $modalEditUser = false;
    public ?array $selectedMember = null;

    public function showModalEditUser($member) {
        if ($this->isModerator)
            $this->modalEditUser = true;
            $this->selectedMember = $member;
    }

    public function closeModalEditUser() {
        $this->modalEditUser = false;
        $this->selectedMember = null;
    }
}; ?>

<div>
    <table class="min-w-full divide-y-2 divide-gray-300 bg-white">
        <thead>
            <tr>
                <td class="px-4 py-2 font-myriad-bold">№</td>
                <td class="px-4 py-2 font-myriad-bold">ФИО</td>
                <td class="px-4 py-2 font-myriad-bold">Вакансия</td>
                <td class="px-4 py-2 font-myriad-bold">Роль</td>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @foreach ($members as $key => $member)
                @php($fullName = "{$member["second_name"]} {$member["first_name"]} {$member["last_name"]}")
                @if ($key % 2 === 0)
                    <x-team.member
                        :class="$isModerator? 'hover:bg-blue-200' : ''"
                        :index="$loop->index + 1"
                        :fullName="$fullName"
                        :vacancy="$member['vacancy_name']"
                        :isModerator="$member['is_moderator']"
                        wire:click="showModalEditUser({{ json_encode($member) }})"
                    />
                @else
                    <x-team.member
                        :class="$isModerator? 'bg-gray-50 hover:bg-blue-200' : 'bg-gray-50'"
                        :index="$loop->index + 1"
                        :fullName="$fullName"
                        :vacancy="$member['vacancy_name']"
                        :isModerator="$member['is_moderator']"
                        wire:click="showModalEditUser({{ json_encode($member) }})"
                    />
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="border-t border-gray-300 px-4 py-2">
        Участников: {{ count($members) }}/{{ $maxTeamMembers }}
    </div>

    @if($modalEditUser)
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-xl font-semibold mb-4">Участник команды</h2>

            <p class="mb-4">
                <strong style="font-weight: bold; color: #4b4b4b; font-size: 16px;">{{ $selectedMember['first_name'] }} {{ $selectedMember['last_name'] }}</strong>
            </p>            

            <h2 class="text-xl font-semibold mb-4">Изменить вакансию</h2>
            <select id="vacancy" wire:model="selectedVacancy" class="border border-gray-300 rounded px-3 py-2 bg-white w-full focus:outline-none text-lg">
                <option value="">Нет вакансии</option>
                @foreach ($vacancies as $vacancy)
                    <option value="{{ $vacancy['vacancy_name'] }}">{{ $vacancy['vacancy_name'] }}</option>
                @endforeach
            </select>
            
            @if (!$selectedMember['is_moderator'])
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mt-6">Удалить из команды</button>
            @endif
    
            <div class="flex justify-end space-x-4 mt-4">
                <button class="text-gray-600 hover:text-gray-800" wire:click="closeModalEditUser">Отмена</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" wire:click="closeModalEditUser">Сохранить</button>
            </div>
        </div>
    </div>
    @endif
</div>