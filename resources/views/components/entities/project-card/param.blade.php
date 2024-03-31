@props(["term" => "", "value" => ""])

<div {{ $attributes->merge(["class" => "flex space-x-2"]) }}>
  <dt>{{ $term }}</dt>
  <dd class="font-medium">{{ $value }}</dd>
</div>
