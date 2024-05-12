<?php

use App\Facades\Tags;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public $tasks;
    public $flow;

    public function tags($taskId)
    {
        return Tags::getTags($taskId);
    }
}; ?>

<div class="mt-4 space-y-8">
    @foreach ($tasks as $task)
        <x-task-card
            :task="$task"
            :flow="$flow"
            :tags="$this->tags($task['id'])"
        />
    @endforeach
</div>
