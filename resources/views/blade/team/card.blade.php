@props(["team" => null, "maxTeamMembers" => "", "flow" => "", "members" => [], "tags" => []])

<x-card.root {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-card.tags :tags="$tags" />
        </div>
    @endif

    <x-card.body>
        <div class="flex items-center justify-between">
            <x-card.title href="#">
                {{ $team["team_name"] }}
            </x-card.title>

            @if ($flow)
                <span class="font-myriad-semibold text-sm text-slate-600">
                    {{ $flow }}
                </span>
            @endif
        </div>

        <x-card.subtitle>
            {{ $team["task_name"] }}
        </x-card.subtitle>

        @if ($team["team_description"] != "")
            <x-card.text class="mt-4">
                {{ $team["team_description"] }}
            </x-card.text>
        @endif
    </x-card.body>

    <div class="border-t border-gray-300 p-8">
        <div
            class="overflow-x-auto rounded-lg border border-gray-300 text-sm shadow-sm shadow-gray-300"
        >
            <table class="min-w-full divide-y-2 divide-gray-300 bg-white">
                <thead>
                    <tr>
                        <td class="px-4 py-2 font-myriad-bold">№</td>
                        <td class="px-4 py-2 font-myriad-bold">ФИО</td>
                        <td class="px-4 py-2 font-myriad-bold">Вакансия</td>
                        <td class="px-4 py-2 font-myriad-bold">Роль</td>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($members as $member)
                        @php($fullName = "{$member["second_name"]} {$member["first_name"]} {$member["last_name"]}")
                        <x-team.member
                            :index="$loop->index + 1"
                            :fullName="$fullName"
                            :vacancy="$member['vacancy_name']"
                            :isModerator="$member['is_moderator']"
                        />
                    @endforeach
                </tbody>
            </table>
            <div class="border-t border-gray-300 px-4 py-2">
                Участников: {{ count($members) }}/{{ $maxTeamMembers }}
            </div>
        </div>
        <x-card.button
            href="#"
            wire:navigate
            class="mt-4"
        >
            Перейти
        </x-card.button>
    </div>
</x-card.root>
