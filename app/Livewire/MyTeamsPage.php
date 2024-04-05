<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class MyTeamsPage extends Component
{
    #[Title('Мои команды')]
    public function render()
    {
        return view('my-teams-page');
    }
}
