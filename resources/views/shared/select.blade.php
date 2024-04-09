@props(["id" => "", "label" => ""])

<div {{ $attributes->merge(["class" => "w-fit"]) }}>
  <label class="block w-fit" for="{{ $id }}">
    {{ $label }}
  </label>
  <select
    class="w-full rounded-lg border-2 border-gray-300 bg-sevsu-light-gray p-3 outline-none focus:border-sevsu-blue"
    id="{{ $id }}"
  >
    {{ $slot }}
  </select>
</div>
