<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithCustomPagination
{
    use WithPagination;

    public function paginationView()
    {
        return 'blade.pagination';
    }
}
