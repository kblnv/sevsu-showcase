@props(["index" => "", "fullName" => "", "role" => "", "position" => ""])

<tr {{ $attributes }}>
  <td class="px-4 py-2">{{ $index }}</td>
  <td class="px-4 py-2">{{ $fullName }}</td>
  <td class="px-4 py-2">{{ $role }}</td>
  <td class="px-4 py-2">{{ $position }}</td>
</tr>
