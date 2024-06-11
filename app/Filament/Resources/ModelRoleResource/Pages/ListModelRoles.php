<?php

namespace App\Filament\Resources\ModelRoleResource\Pages;

use App\Filament\Resources\ModelRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModelRoles extends ListRecords
{
    protected static string $resource = ModelRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
