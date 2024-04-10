@props(["index" => "", "fullName" => "", "vacancy" => "", "isModerator" => false])

<tr {{ $attributes }}>
  <td class="px-4 py-2">{{ $index }}</td>
  <td class="px-4 py-2">{{ $fullName }}</td>
  <td class="px-4 py-2">{{ $vacancy }}</td>
  <td class="px-4 py-2">
    {{ $isModerator ? "Создатель команды" : "Участник команды" }}
  </td>
</tr>
