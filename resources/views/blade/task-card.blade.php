@props(["flow" => null, "task" => null, "tags" => []])

<x-card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-card.tags :tags="$tags" />
        </div>
    @endif

    <x-card.body>
        <x-card.title
            href="{{ route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']]) }}"
            wire:navigate
        >
            {{ $task["task_name"] }}
        </x-card.title>

        @if ($task["customer"] != "")
            <x-card.subtitle>
                {{ $task["customer"] }}
            </x-card.subtitle>
        @endif

        <x-card.text class="mt-4">
            {{ $task["task_description"] }}
        </x-card.text>

        <dl class="mt-4 grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
            <x-task-card.param
                :value="$flow['take_before']"
                term="Взять проект до:"
            />
            <x-task-card.param
                :value="$flow['finish_before']"
                term="Сдать проект до:"
            />
            <x-task-card.param
                :value="$flow['max_team_size']"
                term="Максимум человек в команде:"
            />
            <x-task-card.param
                :value="$task['max_projects']"
                term="Максимальное количество команд:"
            />
        </dl>
    </x-card.body>
</x-card>
