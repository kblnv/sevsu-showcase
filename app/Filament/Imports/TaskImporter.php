<?php

namespace App\Filament\Imports;

use App\Models\Flow;
use App\Models\Task;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TaskImporter extends Importer
{
    protected static ?string $model = Task::class;

    private static bool $importFailure = false;

    private static int $failureCounter = 0;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('task_name')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->label('Название задачи'),
            ImportColumn::make('task_description')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->label('Описание задачи'),
            ImportColumn::make('customer')
                ->rules(['max:255'])
                ->label('Заказчик'),
            ImportColumn::make('max_projects')
                ->numeric()
                ->rules(['integer'])
                ->label('Макс. количество команд'),
            ImportColumn::make('flow_name')
                ->rules(['required', 'max:255'])
                ->label('Название дисциплины'),
        ];
    }

    public function resolveRecord(): ?Task
    {
        $flow = Flow::where('flow_name', $this->data['flow_name'])->first();

        if (! $flow) {
            TaskImporter::$importFailure = true;
            TaskImporter::$failureCounter++;

            return null;
        }

        Task::createOrFirst([
            'task_name' => $this->data['task_name'],
            'task_description' => $this->data['task_description'],
            'customer' => $this->data['customer'],
            'max_projects' => $this->data['max_projects'],
            'flow_id' => $flow->id,
        ]);

        return null;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {

        $body = 'Импортирование задач завершено. '.number_format($import->getFailedRowsCount()).' '.str('задач').' импортировано.';

        if (TaskImporter::$importFailure) {
            $body .= ' '.number_format(TaskImporter::$failureCounter).' '.str('задач').' не удалось импортировать.';
            TaskImporter::$importFailure = false;
            TaskImporter::$failureCounter = 0;
        }

        return $body;
    }
}
