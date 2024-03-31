@props(["label" => ""])

<label class="block w-fit" for="{{ $attributes["id"] }}">{{ $label }}</label>
<select
  {{ $attributes->merge(["class" => "rounded-lg border-2 border-gray-300 bg-sevsu-light-gray p-3 outline-none focus:border-sevsu-blue"]) }}
>
  {{ $slot }}
</select>
