@props(["href" => ""])

<a
    {{ $attributes->merge(["class" => "group flex w-fit items-center justify-between gap-4 rounded-lg border px-5 py-3 transition-shadow hover:ring"]) }}
    href="{{ $href }}"
>
    <span class="font-medium transition-colors group-hover:text-sevsu-blue">
        {{ $slot }}
    </span>

    <svg
        class="size-4 group-hover:text-sevsu-blue rtl:rotate-180"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M17 8l4 4m0 0l-4 4m4-4H3"
        />
    </svg>
</a>
