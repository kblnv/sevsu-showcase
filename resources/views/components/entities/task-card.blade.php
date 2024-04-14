@props(["title" => "", "customer" => "", "description" => "", "takeBefore" => "", "finishBefore" => "", "maxTeamMembers" => "", "maxTeams" => "", "tags" => []])

<x-shared.card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-shared.card.tags :tags="$tags" />
        </div>
    @endif

    <x-shared.card.body>
        <x-shared.card.title href="#">
            {{ $title }}
        </x-shared.card.title>

        @if ($customer != "")
            <x-shared.card.subtitle>
                {{ $customer }}
            </x-shared.card.subtitle>
        @endif

        <x-shared.card.text class="mt-4">
            {{ $description }}
        </x-shared.card.text>

        <dl class="mt-4 grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
            <x-entities.task-card.param
                :value="$takeBefore"
                term="Взять проект до:"
            />
            <x-entities.task-card.param
                :value="$finishBefore"
                term="Сдать проект до:"
            />
            <x-entities.task-card.param
                :value="$maxTeamMembers"
                term="Максимум человек в команде:"
            />
            <x-entities.task-card.param
                :value="$maxTeams"
                term="Максимальное количество команд:"
            />
        </dl>
    </x-shared.card.body>
</x-shared.card>
