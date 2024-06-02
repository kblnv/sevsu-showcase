<?php

namespace App\Filament\Widgets;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = User::query()->count();
        $teamCount = Team::query()->count();

        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $activityData = User::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get()
            ->pluck('count')
            ->toArray();

        return [
            Stat::make('Пользователи', $userCount)
                ->description('Все пользователи')
                ->chart($activityData)
                ->color('success'),
            Stat::make('Команды', $teamCount)
                ->description('Все команды')
                ->color('secondary'),
            Stat::make('Активность', '')
                ->description('За последние 30 дней')
                ->chart($activityData)
                ->color('info'),
        ];
    }
}
