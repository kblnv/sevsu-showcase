<?php

use Livewire\Volt\Component;
use App\Facades\Teams;
use App\Models\Team;
use App\Models\Flow;
use App\Models\Task;
use Livewire\Attributes\Reactive;

new class extends Component {
    #[Reactive]
    public ?Team $team = null;
    public ?Task $task = null;
    public ?Flow $flow = null;
    public ?bool $isChanging = false;

    public string $teamName = '';
    public ?string $teamDescription = null; // Updated type to string

    public string $password = '';

    public function mount() {
        $this->teamName = $this->team?->team_name ?? '';
        $this->teamDescription = $this->team?->team_description ?? '';
    }

    public function handleTeamChange() {
        $this->validate([
            'teamDescription' => 'nullable|string|min:5',
        ]); 
        Teams::updateTeam($this->flow['id'], $this->team['id'], $this->teamName, $this->teamDescription, $this->isChanging);
        Teams::setPassword($this->team['id'], $this->password);
        $this->js('window.location.reload()');
    }

    public function createTeam()
    {
        $this->validate([
                'teamName' => 'required|string|min:5|unique_team_flow:' . $this->flow['id'],
                'teamDescription' => 'nullable|string|min:10',
                'password' => 'nullable',
            ]);

        Teams::createTeam(
            $this->teamName,
            $this->task["id"],
            $this->teamDescription,
            $this->password,
        );

        return $this->redirectRoute("my-teams.index");
    }

    public function messages(): array
    {
        return [
            "teamName.required" => "Это поле обязательно для ввода",
            "teamName.unique_team_flow" =>
                "Команда с таким именем уже существует внутри потока задачи.",
            "teamName.min" =>
                "Название команды должно состоять минимум из 5 символов",
            "teamDescription.min" =>
                "Описание команды должно состоять минимум из 10 символов",
        ];
    }

}; ?>

<form class="flex flex-col gap-4 py-6" wire:submit="createTeam">
    <div>
        <label
            class="text-md block font-medium leading-6 text-gray-700"
            for="team-name"
        >
            Название команды *
        </label>
        <x-input
            class="{{ $errors->has('teamName')  ? 'border-red-700' : '' }}"
            id="team-name"
            wire:model="teamName"
        />
        <div>
            @error("teamName")
                <span class="error text-red-700">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label
            class="text-md block font-medium leading-6 text-gray-700"
            for="team-description"
        >
            Описание команды
        </label>
        <div id="toolbar" wire:ignore>
            <button class="ql-bold">Жирный</button>
            <button class="ql-italic">Курсив</button>
            <button class="ql-underline">Подчеркнутый</button>
            <button class="ql-link">Вставить ссылку</button>
        </div>
        <div id="editor" wire:ignore wire:model.debounce.500ms="teamDescription" x-data x-init="
            let quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Введите описание команды',
                modules: {
                    toolbar: '#toolbar'
                }
            });

            let editorContainer = document.getElementsByClassName('ql-editor')[0];

            quill.on('text-change', function() {
                $wire.set('teamDescription', editorContainer.innerHTML);
            });
            "  class="h-48 overflow-y-auto">
        </div>
            
        <div>
            @error("teamDescription")
                <span class="error text-red-700">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label
            class="text-md block font-medium leading-6 text-gray-700"
            for="password"
        >
            Пароль
        </label>
        <x-input id="password" type="password" wire:model.live="password" />
    </div>
    @if (!$isChanging)
        <div class="mt-4">
            <x-button type="submit" element="button" variant="blue">
                Создать команду
            </x-button>
        </div>
    @else
        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" wire:click="handleTeamChange">Сохранить</button> 
    @endif
</form>