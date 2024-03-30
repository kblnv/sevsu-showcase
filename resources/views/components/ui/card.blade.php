@props(['title' => '', 'customer' => '', 'description' => '', 'params' => ''])

<div
  {{ $attributes->merge(["class" => "overflow-hidden rounded-lg border border-gray-300 bg-sevsu-white p-8 transition-shadow duration-300 hover:shadow-md"]) }}
>
  {{ $slot }}
</div>
