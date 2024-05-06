@props(["flow" => null, "task" => null, "tags" => []])

<x-ui.card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-ui.card.tags :tags="$tags" />
        </div>
    @endif

    <x-ui.card.body>
        <x-ui.card.title
            href="{{ route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']]) }}"
            wire:navigate
        >
            {{ $task["task_name"] }}
        </x-ui.card.title>

        @if ($task["customer"] != "")
            <x-ui.card.subtitle>
                {{ $task["customer"] }}
            </x-ui.card.subtitle>
        @endif

        <x-ui.card.text class="mt-4">
            {{ $task["task_description"] }}
        </x-ui.card.text>

        <dl class="mt-4 grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
            <x-components.task-card.param
                :value="$flow['take_before']"
                term="Взять проект до:"
            />
            <x-components.task-card.param
                :value="$flow['finish_before']"
                term="Сдать проект до:"
            />
            <x-components.task-card.param
                :value="$flow['max_team_size']"
                term="Максимум человек в команде:"
            />
            <x-components.task-card.param
                :value="$task['max_projects']"
                term="Максимальное количество команд:"
            />
        </dl>
    </x-ui.card.body>
</x-ui.card>
