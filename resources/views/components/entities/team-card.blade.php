@props(["title" => "", "task" => "", "description" => "", "maxTeamMembers" => "", "flow" => "", "members" => [], "tags" => []])

<x-shared.card {{ $attributes }}>
    @if (count($tags) != 0)
        <div class="border-b border-gray-300 p-2">
            <x-shared.card.tags :tags="$tags" />
        </div>
    @endif

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

        @if ($description != "")
            <x-shared.card.text class="mt-4">
                {{ $description }}
            </x-shared.card.text>
        @endif
    </x-shared.card.body>

    <div class="border-t border-gray-300 p-8">
        <div
            class="overflow-x-auto rounded-lg border border-gray-300 text-sm shadow shadow-gray-300"
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
                        <x-entities.team-card.member
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
    </div>
</x-shared.card>
