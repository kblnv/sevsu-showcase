@props(["index" => "", "fullName" => "", "role" => "", "position" => ""])

<tr {{ $attributes }}>
  <td class="px-4 py-2 text-slate-600">{{ $index }}</td>
  <td class="px-4 py-2 text-slate-600">{{ $fullName }}</td>
  <td class="px-4 py-2 text-slate-600">{{ $role }}</td>
  <td class="px-4 py-2 text-slate-600">{{ $position }}</td>
</tr>
