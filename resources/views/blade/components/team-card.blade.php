@props(["team" => null, "maxTeamMembers" => "", "flow" => "", "members" => [], "tags" => []])

<x-ui.card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-ui.card.tags :tags="$tags" />
        </div>
    @endif

    <x-ui.card.body>
        <div class="flex items-center justify-between">
            <x-ui.card.title href="#">
                {{ $team["team_name"] }}
            </x-ui.card.title>

            @if ($flow)
                <span class="font-myriad-semibold text-sm text-slate-600">
                    {{ $flow }}
                </span>
            @endif
        </div>

        <x-ui.card.subtitle>
            {{ $team["task_name"] }}
        </x-ui.card.subtitle>

        @if ($team["team_description"] != "")
            <x-ui.card.text class="mt-4">
                {{ $team["team_description"] }}
            </x-ui.card.text>
        @endif
    </x-ui.card.body>

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
                        <x-components.team-card.member
                            :index="$loop->index + 1"
                            :fullName="$fullName"
                            :vacancy="$member['vacancy']"
                            :isModerator="$member['is_moderator']"
                        />
                    @endforeach
                </tbody>
            </table>
            <div class="border-t border-gray-300 px-4 py-2">
                Участников: {{ count($members) }}/{{ $maxTeamMembers }}
            </div>
        </div>
    </div>
</x-ui.card>
