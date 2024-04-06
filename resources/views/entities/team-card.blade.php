@props(["title" => "", "project" => "", "description" => "", "maxTeamMembers" => "", "flow" => "", "persons" => [], "tags" => []])

<x-shared.card {{ $attributes }}>
  <x-shared.card.header>
    <x-shared.card.tags :tags="$tags" />
  </x-shared.card.header>

  <x-shared.card.body>
    <div class="flex items-center justify-between">
      <x-shared.card.title href="#">
        {{ $title }}
      </x-shared.card.title>

      @if ($flow)
        <span class="text-sm text-slate-600 font-main-semibold">{{ $flow }}</span>
      @endif
    </div>

    <x-shared.card.subtitle>
      {{ $project }}
    </x-shared.card.subtitle>

    <div class="mt-4">
      <x-shared.card.text>
        {{ $description }}
      </x-shared.card.text>
    </div>
  </x-shared.card.body>

  <x-shared.card.footer class="border-t-2">
    <div class="overflow-x-auto rounded-lg border border-gray-200 text-sm">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white">
        <thead>
          <tr>
            <td class="px-4 py-2 font-main-bold">№</td>
            <td class="px-4 py-2 font-main-bold">ФИО</td>
            <td class="px-4 py-2 font-main-bold">Роль</td>
            <td class="px-4 py-2 font-main-bold">Статус</td>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @foreach ($persons as $person)
            <x-entities.team-card.person
              :index="$loop->index + 1"
              :fullName="$person['fullName']"
              :role="$person['role']"
              :position="$person['position']"
            />
          @endforeach
        </tbody>
      </table>

      <div
        class="rounded-b-lg border-t border-gray-200 px-4 py-2"
      >
        Участников: {{ count($persons) }}/{{ $maxTeamMembers }}
      </div>
    </div>
  </x-shared.card.footer>
</x-shared.card>
