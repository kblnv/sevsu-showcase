<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Мои команды')]
class MyTeamsPage extends Component
{
    public function render()
    {
        return view('my-teams-page');
    }
}
