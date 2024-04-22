@props(["flow" => null , "task" => null, "tags" => []])


<x-shared.card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-shared.card.tags :tags="$tags" />
        </div>
    @endif

    <x-shared.card.body>
        <x-shared.card.title
            href="{{ route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']]) }}"
            wire:navigate
        >
            {{ $task['task_name'] }}
        </x-shared.card.title>

        @if ($task['customer'] != "")
            <x-shared.card.subtitle>
                {{ $task['customer'] }}
            </x-shared.card.subtitle>
        @endif

        <x-shared.card.text class="mt-4">
            {{ $task['task_description'] }}
        </x-shared.card.text>

        <dl class="mt-4 grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
            <x-entities.task-card.param
                :value="$flow['take_before']"
                term="Взять проект до:"
            />
            <x-entities.task-card.param
                :value="$flow['finish_before']"
                term="Сдать проект до:"
            />
            <x-entities.task-card.param
                :value="$flow['max_team_size']"
                term="Максимум человек в команде:"
            />
            <x-entities.task-card.param
                :value="$task['max_projects']"
                term="Максимальное количество команд:"
            />
        </dl>
    </x-shared.card.body>
</x-shared.card>
