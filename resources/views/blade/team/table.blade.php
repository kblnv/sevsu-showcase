@props(["members" => [], "maxTeamMembers" => ""])

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
