@props(["href" => ""])

<h2 class="text-xl">
  <a
    href="{{ $href }}"
    {{ $attributes->merge(["class" => "transition-colors hover:text-sevsu-blue"]) }}
  >
    {{ $slot }}
  </a>
</h2>
