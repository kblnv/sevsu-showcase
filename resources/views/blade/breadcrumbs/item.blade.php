@props(["title" => "", "link" => "", "muted" => false, "first" => false])

<li class="inline-flex items-center">
    <div class="flex items-center">
        @if (! $first)
            <x-arrow.up class="h-3 w-3 rotate-90" stroke-width="2" />
        @endif

        @if ($muted)
            <span
                class="ms-1 font-myriad-regular text-sm text-gray-500 md:ms-2"
            >
                {{ $title }}
            </span>
        @else
            <a
                class="ms-1 inline-flex items-center font-myriad-regular text-sm transition-colors hover:text-sevsu-blue"
                href="{{ $link }}"
                wire:navigate
            >
                {{ $title }}
            </a>
        @endif
    </div>
</li>
