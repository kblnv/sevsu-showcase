<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class TeamsPage extends Component
{
    #[Title('Команды')]
    public function render()
    {
        return view('teams-page');
    }
}
