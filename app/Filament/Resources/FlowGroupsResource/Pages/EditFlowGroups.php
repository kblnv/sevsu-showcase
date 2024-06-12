<?php

namespace App\Filament\Resources\FlowGroupsResource\Pages;

use App\Filament\Resources\FlowGroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlowGroups extends EditRecord
{
    protected static string $resource = FlowGroupsResource::class;

    protected static ?string $title = 'Редактировать Дисциплину';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
