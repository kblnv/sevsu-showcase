@props(["element" => "button", "variant" => "outline", "href" => "#"])

@if ($variant === "outline")
    <button
        {{ $attributes->merge(["class" => "group flex w-fit items-center justify-between gap-4 rounded-lg border px-5 py-3 transition-shadow hover:ring hover:text-sevsu-blue"]) }}
    >
        @if ($element === "button")
            {{ $slot }}
        @elseif ($element === "link")
            <a href="{{ $href }}" wire:navigate>{{ $slot }}</a>
        @endif
    </button>
@elseif ($variant === "blue")
    <button
        {{ $attributes->merge(["class" => "leading inline-flex items-center rounded-md border border-transparent bg-sevsu-blue px-4 py-2 text-sm font-medium text-white"]) }}
    >
        @if ($element === "button")
            {{ $slot }}
        @elseif ($element === "link")
            <a href="{{ $href }}" wire:navigate>{{ $slot }}</a>
        @endif
    </button>
@endif
