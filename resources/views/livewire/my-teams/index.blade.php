<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

new
#[Title('Мои команды')]
class extends Component {
    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return [
            "Дисциплина 1" => [
                "maxTeamMembers" => "10",
                "team" => [
                    "title" => "Команда дисциплины 1",
                    "task" => "Задача команды дисциплины 1",
                    "description" => "Описание команады дисциплины 1",
                    "tags" => ['Веб-программирование', 'Профессиональный трек'],
                    "members" => [
                        [
                            "fullName" => "Кабалинов Максим Владимирович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => true
                        ],
                        [
                            "fullName" => "Аракелян Сурен Рубенович",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Семенов Валентин Андреевич",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Остапович Андрей Викторович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => false
                        ],
                    ]
                ],
            ],
            "Дисциплина 2" => [
                "maxTeamMembers" => "10",
                "team" => [
                    "title" => "Команда дисциплины 2",
                    "task" => "Задача команды дисциплины 2",
                    "description" => "Описание команады дисциплины 2",
                    "tags" => ['Веб-программирование', 'Профессиональный трек'],
                    "members" => [
                        [
                            "fullName" => "Кабалинов Максим Владимирович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => true
                        ],
                        [
                            "fullName" => "Аракелян Сурен Рубенович",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Семенов Валентин Андреевич",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Остапович Андрей Викторович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => false
                        ],
                    ]
                ]
            ],
            "Дисциплина 3" => [
                "maxTeamMembers" => "10",
                "team" => [
                    "title" => "Команда дисциплины 3",
                    "task" => "Задача команды дисциплины 3",
                    "description" => "Описание команады дисциплины 3",
                    "tags" => ['Веб-программирование', 'Профессиональный трек'],
                    "members" => [
                        [
                            "fullName" => "Кабалинов Максим Владимирович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => true
                        ],
                        [
                            "fullName" => "Аракелян Сурен Рубенович",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Семенов Валентин Андреевич",
                            "vacancy" => "Back-end разработчик",
                            "isModerator" => false
                        ],
                        [
                            "fullName" => "Остапович Андрей Викторович",
                            "vacancy" => "Front-end разработчик",
                            "isModerator" => false
                        ],
                    ]
                ]
            ]
        ];
    }

    public function hasTeams()
    {
        $hasTeams = false;
        foreach ($this->flows as $flow => $params) {
            if (! empty($params)) {
                $hasTeams = true;
            }
        }
        return $hasTeams;
    }

}; ?>

<div>
    @if (count($this->flows) == 0 || ! $this->hasTeams())
        <x-shared.page-heading>
            Вы не состоите ни в одной команде
        </x-shared.page-heading>
    @else
        <x-shared.page-heading>
            Все команды, в которых Вы состоите:
        </x-shared.page-heading>

        <div class="mt-4 space-y-8">
            @foreach ($this->flows as $flow => $params)
                @if (! empty($params))
                    <x-entities.team-card
                        :title="$params['team']['title']"
                        :task="$params['team']['task']"
                        :flow="$flow"
                        :description="$params['team']['description']"
                        :maxTeamMembers="$params['maxTeamMembers']"
                        :tags="$params['team']['tags']"
                        :members="$params['team']['members']"
                    />
                @endif
            @endforeach
        </div>
  @endif
</div>
