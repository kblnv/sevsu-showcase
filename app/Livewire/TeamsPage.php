<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Команды')]
class TeamsPage extends Component
{
    public function render()
    {
        return view('teams-page');
    }
}
