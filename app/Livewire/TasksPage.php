<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class TasksPage extends Component
{
    #[Title('Банк задач')]
    public function render()
    {
        return view('tasks-page');
    }
}
