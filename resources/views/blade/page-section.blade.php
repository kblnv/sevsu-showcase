@props(["title" => ""])

@php
    $uniqueId = uniqid();
    $showSection = "show_$uniqueId";
@endphp

<section x-data="{ {{ $showSection }}: true }">
    <button
        class="flex items-center gap-2"
        type="button"
        @click="{{ $showSection }} = !{{ $showSection }}"
    >
        <div class="size-5">
            <x-arrow-up x-show="{{ $showSection }}" />
            <x-arrow-down x-show="!{{ $showSection }}" x-cloak />
        </div>
        <x-page-heading>{{ $title }}</x-page-heading>
    </button>

    <div x-show="{{ $showSection }}">
        {{ $slot }}
    </div>
</section>
