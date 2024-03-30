@props(['href' => ''])

<h2 class="text-xl">
  <a class="transition-colors hover:text-sevsu-blue" href="{{ $href }}">
    {{ $slot }}
  </a>
</h2>
