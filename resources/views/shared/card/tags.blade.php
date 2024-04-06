@props(["tags" => []])

<div {{ $attributes->merge(["class" => "flex flex-col gap-2 sm:flex-row"]) }}>
  @foreach ($tags as $tag)
    <x-shared.tag>{{ $tag }}</x-shared.tag>
  @endforeach
</div>
