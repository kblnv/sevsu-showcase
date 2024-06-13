<?php

namespace App\Filament\Resources;

use App\Filament\Exports\TaskExporter;
use App\Filament\Imports\TaskImporter;
use App\Filament\Resources\TaskResource\Pages;
use App\Models\Flow;
use App\Models\Tag;
use App\Models\Task;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Задачи';

    protected static ?string $pluralLabel = 'Задачи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('task_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название'),
                TextInput::make('customer')
                    ->maxLength(255)
                    ->label('Заказчик'),
                TextInput::make('max_projects')
                    ->inputMode('decimal')
                    ->rules('gt:0')
                    ->validationMessages([
                        'gt' => 'Значение :attribute должно быть больше 0.',
                    ])
                    ->label('Макс. количество команд'),
                Select::make('flow_id')
                    ->searchable()
                    ->options(Flow::pluck('flow_name', 'id'))
                    ->required()
                    ->rules('gt:0')
                    ->validationMessages([
                        'gt' => 'Значение должно быть больше 0.',
                    ])
                    ->label('Дисциплина'),
                Select::make('tags')
                    ->multiple()
                    ->relationship('tags', 'tag_name')
                    ->options(Tag::pluck('tag_name', 'id'))
                    ->label('Тэги'),
                Textarea::make('task_description')
                    ->autosize()
                    ->extraAttributes([
                        'style' => 'max-height: 256px; overflow-y: auto;',
                    ])
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255)
                    ->label('Описание'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                ImportAction::make()
                    ->importer(TaskImporter::class),
                ExportAction::make()
                    ->exporter(TaskExporter::class),
            ])
            ->columns([
                TextColumn::make('task_name')
                    ->searchable()
                    ->label('Название'),
                TextColumn::make('task_description')
                    ->searchable()
                    ->label('Описание')
                    ->limit(20),
                TextColumn::make('customer')
                    ->searchable()
                    ->label('Заказчик'),
                TextColumn::make('max_projects')
                    ->sortable()
                    ->searchable()
                    ->label('Макс. количество команд'),
                TextColumn::make('flows.flow_name')
                    ->searchable()
                    ->label('Дисциплина'),
                TextColumn::make('flows.max_team_size')
                    ->sortable()
                    ->searchable()
                    ->numeric()
                    ->label('Макс. размер команды'),
                TextColumn::make('tags.tag_name')
                    ->badge()
                    ->limitList(1)
                    ->label('Тэги'),
                TextColumn::make('flows.take_before')
                    ->sortable()
                    ->label('Взять задачу до'),
                TextColumn::make('flows.finish_before')
                    ->sortable()
                    ->label('Завершить задачу до'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
