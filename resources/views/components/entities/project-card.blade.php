@props(["tags" => []])

<x-shared.card {{ $attributes }}>
  <x-shared.card.header>
    <x-shared.card.tags :tags="$tags" />
  </x-shared.card.header>

  <x-shared.card.body>
    <x-shared.card.title href="#">
      {{ $title }}
    </x-shared.card.title>
    <x-shared.card.subtitle>{{ $customer }}</x-shared.card.subtitle>

    <div class="mt-4">
      <x-shared.card.text>
        {{ $description }}
      </x-shared.card.text>
    </div>
  </x-shared.card.body>

  <x-shared.card.footer>
    <dl class="grid gap-2 text-xs md:grid-cols-2 lg:grid-cols-4">
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
  </x-shared.card.footer>
</x-shared.card>
