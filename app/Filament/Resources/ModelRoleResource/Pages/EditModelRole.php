<?php

namespace App\Filament\Resources\ModelRoleResource\Pages;

use App\Filament\Resources\ModelRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModelRole extends EditRecord
{
    protected static string $resource = ModelRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
