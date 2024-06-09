@props(["team" => null, "maxTeamMembers" => "", "flow" => "", "members" => []])

<x-card.root {{ $attributes }}>
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
                {{ Str::limit($team["team_description"], 1024) }}
            </x-card.text>
        @endif
    </x-card.body>

    <div class="border-t border-gray-300 p-8" x-data="{ showTable: false }">
        @if (count($members) > 1)
            <div class="flex items-center gap-2">
                <x-arrow.down class="h-3 w-3" x-show="!showTable" />
                <x-arrow.down class="h-3 w-3 rotate-180" x-show="showTable" />
                <button
                    class="text-sm"
                    type="button"
                    @click="showTable = !showTable"
                >
                    Показать полностью
                </button>
            </div>
        @endif

        <div
            class="mt-1 overflow-x-auto rounded-lg border border-gray-300 text-sm shadow-sm shadow-gray-300"
            x-cloak
            x-show="showTable"
            x-collapse.min.113
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
                    @foreach ($members as $key => $member)
                        @php($fullName = "{$member["second_name"]} {$member["first_name"]} {$member["last_name"]}")
                        @if ($key % 2 === 0)
                            <x-team.member
                                :index="$loop->index + 1"
                                :fullName="$fullName"
                                :vacancy="$member['vacancy_name']"
                                :isModerator="$member['is_moderator']"
                            />
                        @else
                            <x-team.member
                                class="bg-gray-50"
                                :index="$loop->index + 1"
                                :fullName="$fullName"
                                :vacancy="$member['vacancy_name']"
                                :isModerator="$member['is_moderator']"
                            />
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="border-t border-gray-300 px-4 py-2">
                Участников: {{ count($members) }}/{{ $maxTeamMembers }}
            </div>
        </div>
        <x-page.button
            class="mt-6"
            href="{{ route('teams.show', $team['id']) }}"
            wire:navigate
        >
            Перейти
        </x-page.button>
    </div>
</x-card.root>
