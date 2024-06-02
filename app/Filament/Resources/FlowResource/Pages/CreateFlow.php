<?php

namespace App\Filament\Resources\FlowResource\Pages;

use App\Filament\Resources\FlowResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFlow extends CreateRecord
{
    protected static string $resource = FlowResource::class;

    protected static ?string $title = 'Добавить Дисциплину';
}
