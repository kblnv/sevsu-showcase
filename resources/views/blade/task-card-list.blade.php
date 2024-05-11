@props(["tasks" => [], "flow" => ""])

<div class="mt-4 space-y-8">
    @foreach ($tasks as $task)
        <x-task-card
            :task="$task"
            :flow="$flow"
            :tags="$this->tags($task['id'])"
        />
    @endforeach
</div>
