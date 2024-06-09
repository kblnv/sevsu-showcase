<?php

use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

new class extends Component {
    #[Reactive]
    public $currentTab;
    public $tabs;
}; ?>

<div class="border-b border-gray-200">
    <nav class="-mb-px flex gap-6">
        @foreach ($tabs as $tab)
            @if ($tab === $currentTab)
                <button
                    class="shrink-0 rounded-t-lg border border-gray-300 border-b-white p-3 text-sm font-medium text-sevsu-blue"
                    type="button"
                    wire:click="$parent.switchTab('{{ $tab }}')"
                >
                    {{ $tab }}
                </button>
            @else
                <button
                    class="shrink-0 border border-transparent p-3 text-sm font-medium text-gray-500 hover:text-gray-700"
                    type="button"
                    wire:click="$parent.switchTab('{{ $tab }}')"
                >
                    {{ $tab }}
                </button>
            @endif
        @endforeach
    </nav>
</div>
