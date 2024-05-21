@props(["flow" => null, "task" => null, "tags" => []])

<x-card.root {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-card.tags :tags="$tags" />
        </div>
    @endif

    <x-card.body>
        <x-card.title>
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

        <x-card.button
            href="{{ route('tasks.show', ['flow' => $flow['id'], 'task' => $task['id']]) }}"
            wire:navigate
            class="mt-4"
        >
            Перейти
        </x-card.button>
    </x-card.body>
</x-card.root>
