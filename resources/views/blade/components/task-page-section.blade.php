@props(["sectionTitle" => ""])

@php
    $uniqueId = uniqid();
    $showSection = "show_$uniqueId";
@endphp

<div class="mt-4" x-data="{ {{ $showSection }}: true }">
    <button
        class="flex items-center gap-2"
        type="button"
        @click="{{ $showSection }} = !{{ $showSection }}"
    >
        <div class="size-5">
            <x-ui.arrow-up x-show="{{ $showSection }}" />
            <x-ui.arrow-down x-show="!{{ $showSection }}" x-cloak />
        </div>
        <x-ui.page-heading>{{ $sectionTitle }}</x-ui.page-heading>
    </button>

    <div x-show="{{ $showSection }}">
        {{ $slot }}
    </div>
</div>
