@props(["items" => []])

<nav class="flex" aria-label="Навигация">
    <ol
        class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
    >
        @foreach ($items as $index => $item)
            <li class="inline-flex items-center">
                <div class="flex items-center">
                    @if ($index > 0)
                        <x-arrow-up
                            class="h-3 w-3 rotate-90"
                            stroke-width="2"
                        />
                    @endif

                    @if ($item["currentPage"])
                        <span
                            class="ms-1 font-myriad-regular text-sm text-gray-500 md:ms-2"
                        >
                            {{ $item["title"] }}
                        </span>
                    @else
                        <a
                            class="ms-1 inline-flex items-center font-myriad-regular text-sm transition-colors hover:text-sevsu-blue"
                            href="{{ $item["link"] }}"
                            wire:navigate
                        >
                            {{ $item["title"] }}
                        </a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
