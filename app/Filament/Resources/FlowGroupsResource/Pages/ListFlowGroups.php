<?php

namespace App\Filament\Resources\FlowGroupsResource\Pages;

use App\Filament\Resources\FlowGroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlowGroups extends ListRecords
{
    protected static string $resource = FlowGroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
