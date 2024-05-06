@props(["id" => "", "label" => ""])

<div {{ $attributes }}>
    <label class="block w-fit" for="{{ $id }}">
        {{ $label }}
    </label>
    <input
        class="rounded-lg border-2 border-gray-300 bg-sevsu-light-gray p-3 outline-none focus:border-sevsu-blue"
        id="{{ $id }}"
    />
</div>
