@props(["title" => "", "task" => "", "description" => "", "maxTeamMembers" => "", "flow" => "", "members" => [], "tags" => []])

<x-shared.card {{ $attributes }}>
  <div class="border-b-2 p-2">
    <x-shared.card.tags :tags="$tags" />
  </div>

  <x-shared.card.body>
    <div class="flex items-center justify-between">
      <x-shared.card.title href="#">
        {{ $title }}
      </x-shared.card.title>

      @if ($flow)
        <span class="font-myriad-semibold text-sm text-slate-600">
          {{ $flow }}
        </span>
      @endif
    </div>

    <x-shared.card.subtitle>
      {{ $task }}
    </x-shared.card.subtitle>

    <x-shared.card.text class="mt-4">
      {{ $description }}
    </x-shared.card.text>
  </x-shared.card.body>

  <div class="border-t-2 p-4">
    <div class="overflow-x-auto rounded-lg border border-gray-200 text-sm">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white">
        <thead>
          <tr>
            <td class="px-4 py-2 font-myriad-bold">№</td>
            <td class="px-4 py-2 font-myriad-bold">ФИО</td>
            <td class="px-4 py-2 font-myriad-bold">Роль</td>
            <td class="px-4 py-2 font-myriad-bold">Статус</td>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
          @foreach ($members as $member)
            <x-entities.team-card.member
              :index="$loop->index + 1"
              :fullName="$member['fullName']"
              :vacancy="$member['vacancy']"
              :isModerator="$member['isModerator']"
            />
          @endforeach
        </tbody>
      </table>

      <div class="rounded-b-lg border-t border-gray-200 px-4 py-2">
        Участников: {{ count($members) }}/{{ $maxTeamMembers }}
      </div>
    </div>
  </div>
</x-shared.card>
