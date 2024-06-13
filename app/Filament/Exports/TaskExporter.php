<?php

namespace App\Filament\Exports;

use App\Models\Task;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class TaskExporter extends Exporter
{
    protected static ?string $model = Task::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('Id'),
            ExportColumn::make('task_name')
                ->label('Название задачи'),
            ExportColumn::make('task_description')
                ->label('Описание задачи'),
            ExportColumn::make('customer')
                ->label('Заказчик'),
            ExportColumn::make('max_projects')
                ->label('Макс. количество команд'),
            ExportColumn::make('flow_id')
                ->label('Id дисциплины'),
            ExportColumn::make('created_at')
                ->label('Создано'),
            ExportColumn::make('updated_at')
                ->label('Обновлено'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Экспортирование задач выполнено и '.number_format($export->successful_rows).' '.str('задач').' экспортировано.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('задач').' не удалось экспортировать.';
        }

        return $body;
    }
}
