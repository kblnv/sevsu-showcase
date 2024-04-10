@props(["title" => "", "customer" => "", "description" => "", "takeBefore" => "", "finishBefore" => "", "maxTeamMembers" => "", "maxTeams" => "", "tags" => []])

<x-shared.card {{ $attributes }}>
  @if (count($tags) != 0)
    <div class="border-b-2 p-2">
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

    <div class="mt-4">
      <x-shared.card.text>
        {{ $description }}
      </x-shared.card.text>
    </div>

    <dl class="mt-4 grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
      <x-entities.project-card.param
        value="{{ $takeBefore }}"
        term="Взять проект до:"
      />
      <x-entities.project-card.param
        value="{{ $finishBefore }}"
        term="Сдать проект до:"
      />
      <x-entities.project-card.param
        value="{{ $maxTeamMembers }}"
        term="Максимум человек в команде:"
      />
      <x-entities.project-card.param
        value="{{ $maxTeams }}"
        term="Максимальное количество команд:"
      />
    </dl>
  </x-shared.card.body>
</x-shared.card>
