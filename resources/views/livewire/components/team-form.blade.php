<?php

use Livewire\Volt\Component;
use App\Facades\Teams;
use Livewire\Attributes\Reactive;

new class extends Component {
    public $teamName;
    public $teamDescription;
    public $password;
    #[Reactive]
    public $task;
    public $flow;

    public function rules()
    {
        return [
            "teamName" => [
                "required",
                "string",
                "min:5",
                "unique_team_flow:" . $this->flow["id"],
            ],
            "teamDescription" => "nullable|string|min:10",
            "password" => "nullable",
        ];
    }

    public function messages()
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

    public function createTeam()
    {
        $this->validate();

        Teams::createTeam(
            $this->teamName,
            $this->task["id"],
            $this->teamDescription,
            $this->password,
        );

        return $this->redirectRoute("my-teams.index");
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
            class="{{ $errors->has('teamName') ? 'border-red-700' : '' }}"
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
        <x-textarea
            class="{{ $errors->has('teamDescription') ? 'border-red-700' : '' }}"
            wire:model="teamDescription"
        ></x-textarea>
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
        <x-input id="password" type="password" wire:model="password" />
    </div>
    <div class="mt-4">
        <x-button type="submit">Создать команду</x-button>
    </div>
</form>
