@props(["arrow" => "next", "href" => "", "element" => "link"])

<x-button href="{{ $href }}" element="{{ $element }}" {{ $attributes }}>
    <div class="flex items-center justify-center gap-2">
        @if ($arrow === "next")
            <span
                class="font-medium transition-colors group-hover:text-sevsu-blue"
            >
                {{ $slot }}
            </span>
            <x-arrow.next class="group-hover:text-sevsu-blue" />
        @elseif ($arrow === "back")
            <x-arrow.next class="rotate-180 group-hover:text-sevsu-blue" />
            <span
                class="font-medium transition-colors group-hover:text-sevsu-blue"
            >
                {{ $slot }}
            </span>
        @endif
    </div>
</x-button>
