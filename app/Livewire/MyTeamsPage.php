<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Component;

#[Title('Мои команды')]
class MyTeamsPage extends Component
{
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

    public function render()
    {
        return view('my-teams-page');
    }
}
