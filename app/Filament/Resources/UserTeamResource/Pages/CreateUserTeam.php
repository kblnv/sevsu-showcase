<?php

namespace App\Filament\Resources\UserTeamResource\Pages;

use App\Filament\Resources\UserTeamResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserTeam extends CreateRecord
{
    protected static string $resource = UserTeamResource::class;

    protected static ?string $title = 'Добавить Пользователя';
}
