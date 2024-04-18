<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Flow;
use App\Models\Task;

new #[Title("Задача")] class extends Component {
    public function mount(Flow $flow, Task $task)
    {
        dd($flow, $task);
    }
};
?>

<div></div>
