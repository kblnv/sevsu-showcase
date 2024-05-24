@props(["href" => "", "type" => "next"])

<a
    href="{{ $href }}"
    {{ $attributes->merge(["class" => "group flex w-fit items-center justify-between gap-4 rounded-lg border px-5 py-3 transition-shadow hover:ring"]) }}
>
    @if ($type === "next")
        <span class="font-medium transition-colors group-hover:text-sevsu-blue">
            {{ $slot }}
        </span>
        <x-arrow.next class="group-hover:text-sevsu-blue" />
    @elseif ($type === "back")
        <x-arrow.next class="rotate-180 group-hover:text-sevsu-blue" />
        <span class="font-medium transition-colors group-hover:text-sevsu-blue">
            {{ $slot }}
        </span>
    @endif
</a>
