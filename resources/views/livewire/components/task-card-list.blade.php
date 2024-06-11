<?php

use App\Facades\Tags;
use App\Models\Flow;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public array $tasks = [];
    public ?Flow $flow = null;

    public function getTaskTags(string $taskId): array
    {
        return Tags::getTags($taskId);
    }
}; ?>

<div class="mt-4 space-y-8">
    @foreach ($tasks as $task)
        <x-task.card
            :task="$task"
            :flow="$flow"
            :tags="$this->getTaskTags($task['id'])"
        />
    @endforeach
</div>
