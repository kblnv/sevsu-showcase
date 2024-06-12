<?php

namespace App\Filament\Widgets;

use App\Models\Flow;
use App\Models\Team;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = User::query()->count();
        $teamCount = Team::query()->count();
        $flowCount = Flow::query()->count();

        return [
            Stat::make('Пользователи', $userCount)
                ->description('Все пользователи')
                ->color('secondary'),
            Stat::make('Команды', $teamCount)
                ->description('Все команды')
                ->color('secondary'),
            Stat::make('Дисциплины', $flowCount)
                ->description('Все дисциплины')
                ->color('secondary'),
        ];
    }
}
