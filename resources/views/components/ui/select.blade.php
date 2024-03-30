@props(["label" => ''])

<label for="{{ $attributes['id'] }}" class="block w-fit">{{ $label }}</label>
<select
  {{ $attributes->merge(["class" => "rounded-lg border-2 border-gray-300 bg-sevsu-light-gray p-3 outline-none focus:border-sevsu-blue"]) }}
>
  {{ $slot }}
</select>
