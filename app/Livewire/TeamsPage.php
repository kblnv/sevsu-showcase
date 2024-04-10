<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\Component;

#[Title('Команды')]
class TeamsPage extends Component
{
    #[Url]
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return [
            "Дисциплина 1" => [
                "maxTeamMembers" => "10",
                "teams" => [
                    [
                        "title" => "Задача 1 дисциплины 1",
                        "task" => "Проект дисциплины 1",
                        "description" => "Описание 1 дисциплины 1",
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
                    [
                        "title" => "Задача 2 дисциплины 1",
                        "task" => "Заказчик 2 дисциплины 1",
                        "description" => "Описание 2 дисциплины 1",
                        "maxTeams" => "5",
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
                    [
                        "title" => "Задача 3 дисциплины 1",
                        "task" => "Заказчик 3 дисциплины 1",
                        "description" => "Описание 3 дисциплины 1",
                        "maxTeams" => "5",
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
                ]
            ],
            "Дисциплина 2" => [
                "maxTeamMembers" => "10",
                "teams" => [
                    [
                        "title" => "Задача 1 дисциплины 2",
                        "task" => "Проект дисциплины 1",
                        "description" => "Описание 1 дисциплины 1",
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
                    [
                        "title" => "Задача 2 дисциплины 2",
                        "task" => "Заказчик 2 дисциплины 1",
                        "description" => "Описание 2 дисциплины 1",
                        "maxTeams" => "5",
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
                    [
                        "title" => "Задача 3 дисциплины 2",
                        "task" => "Заказчик 3 дисциплины 1",
                        "description" => "Описание 3 дисциплины 1",
                        "maxTeams" => "5",
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
                        ],
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
                ]
            ],
            "Дисциплина 3" => [
                "maxTeamMembers" => "10",
                "teams" => [
                    [
                        "title" => "Задача 1 дисциплины 3",
                        "task" => "Проект дисциплины 3",
                        "description" => "Описание 1 дисциплины 3",
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
                    [
                        "title" => "Задача 2 дисциплины 3",
                        "task" => "Заказчик 2 дисциплины 3",
                        "description" => "Описание 2 дисциплины 3",
                        "maxTeams" => "5",
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
                    [
                        "title" => "Задача 3 дисциплины 3",
                        "task" => "Заказчик 3 дисциплины 3",
                        "description" => "Описание 3 дисциплины 3",
                        "maxTeams" => "5",
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
                ]
            ],
        ];
    }

    public function mount()
    {
        if ($this->selectedFlow == "" || !array_key_exists($this->selectedFlow, $this->flows)) {
            $this->selectedFlow = array_keys($this->flows)[0] ?? "";
        }
    }

    public function render()
    {
        return view('teams-page', [
            "flowsNames" => array_keys($this->flows)
        ]);
    }
}
