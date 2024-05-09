<?php

namespace App\Traits;

use Livewire\WithPagination;

trait CustomPagination
{
    use WithPagination;

    public function paginationView()
    {
        return 'blade.components.pagination';
    }
}
