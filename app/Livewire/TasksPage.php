<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Банк задач')]
class TasksPage extends Component
{
    public $selectedFlow = "";

    #[Computed(persist: true, seconds: 300)]
    public function flows()
    {
        return [
            "Дисциплина 1" => [
                "takeBefore" => "1 сентября 2024",
                "finishBefore" => "30 декабря 2024",
                "maxTeamMembers" => "10",
                "canCreateTask" => false,
                "tasks" => [
                    [
                        "title" => "Задача 1 дисциплины 1",
                        "customer" => "Заказчик 1 дисциплины 1",
                        "description" => "Описание 1 дисциплины 1",
                        "maxTeams" => "5",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 2 дисциплины 1",
                        "customer" => "Заказчик 2 дисциплины 1",
                        "description" => "Описание 2 дисциплины 1",
                        "maxTeams" => "5",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 3 дисциплины 1",
                        "customer" => "Заказчик 3 дисциплины 1",
                        "description" => "Описание 3 дисциплины 1",
                        "maxTeams" => "5",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                ]
            ],
            "Дисциплина 2" => [
                "takeBefore" => "1 сентября 2024",
                "finishBefore" => "30 декабря 2024",
                "maxTeamMembers" => "4",
                "canCreateTask" => false,
                "tasks" => [
                    [
                        "title" => "Задача 1 дисциплины 2",
                        "customer" => "Заказчик 1 дисциплины 2",
                        "description" => "Описание 1 дисциплины 2",
                        "maxTeams" => "10",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 2 дисциплины 2",
                        "customer" => "Заказчик 2 дисциплины 2",
                        "description" => "Описание 2 дисциплины 2",
                        "maxTeams" => "10",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 3 дисциплины 2",
                        "customer" => "Заказчик 3 дисциплины 2",
                        "description" => "Описание 3 дисциплины 2",
                        "maxTeams" => "10",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                ]
            ],
            "Дисциплина 3" => [
                "takeBefore" => "10 сентября 2025",
                "finishBefore" => "31 декабря 2025",
                "maxTeamMembers" => "6",
                "canCreateTask" => false,
                "tasks" => [
                    [
                        "title" => "Задача 1 дисциплины 3",
                        "customer" => "Заказчик 1 дисциплины 3",
                        "description" => "Описание 1 дисциплины 3",
                        "maxTeams" => "15",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 2 дисциплины 3",
                        "customer" => "Заказчик 2 дисциплины 3",
                        "description" => "Описание 2 дисциплины 3",
                        "maxTeams" => "15",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                    [
                        "title" => "Задача 3 дисциплины 3",
                        "customer" => "Заказчик 3 дисциплины 3",
                        "description" => "Описание 3 дисциплины 3",
                        "maxTeams" => "15",
                        "tags" => ['Веб-программирование', 'Профессиональный трек']
                    ],
                ]
            ]
        ];
    }

    public function mount()
    {
        $this->selectedFlow = array_keys($this->flows)[0];
    }

    public function render()
    {
        return view('tasks-page', [
            "flowsNames" => array_keys($this->flows)
        ]);
    }
}
