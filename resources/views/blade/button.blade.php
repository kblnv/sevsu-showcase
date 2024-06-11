@props(["element" => "button", "variant" => "outline", "href" => "#"])

@php
    $outlineClass =
        "group flex w-fit items-center justify-between gap-4 rounded-lg border px-5 py-3 text-base transition-shadow hover:text-sevsu-blue hover:ring";
    $blueClass =
        "leading inline-flex items-center rounded-md border border-transparent bg-sevsu-blue px-4 py-2 text-base font-medium text-white";
@endphp

@if ($element === "link")
    @if ($variant === "outline")
        <a
            href="{{ $href }}"
            {{ $attributes->merge(["class" => $outlineClass]) }}
            wire:navigate
        >
            {{ $slot }}
        </a>
    @elseif ($variant === "blue")
        <a
            href="{{ $href }}"
            {{ $attributes->merge(["class" => $blueClass]) }}
            wire:navigate
        >
            {{ $slot }}
        </a>
    @endif
@elseif ($element === "button")
    @if ($variant === "outline")
        <button {{ $attributes->merge(["class" => $outlineClass]) }}>
            {{ $slot }}
        </button>
    @elseif ($variant === "blue")
        <button {{ $attributes->merge(["class" => $blueClass]) }}>
            {{ $slot }}
        </button>
    @endif
@endif
