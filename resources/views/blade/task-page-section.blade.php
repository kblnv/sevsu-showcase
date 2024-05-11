@props(["sectionTitle" => ""])

@php
    $uniqueId = uniqid();
    $showSection = "show_$uniqueId";
@endphp

<div x-data="{ {{ $showSection }}: true }">
    <button
        class="flex items-center gap-2"
        type="button"
        @click="{{ $showSection }} = !{{ $showSection }}"
    >
        <div class="size-5">
            <x-arrow-up x-show="{{ $showSection }}" />
            <x-arrow-down x-show="!{{ $showSection }}" x-cloak />
        </div>
        <x-page-heading>{{ $sectionTitle }}</x-page-heading>
    </button>

    <div x-show="{{ $showSection }}">
        {{ $slot }}
    </div>
</div>
