<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Flow;
use App\Models\Task;
use App\Models\Team;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Команды';

    protected static ?string $pluralLabel = 'Команды';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('team_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название'),
                Textarea::make('team_description')
                    ->autosize()
                    ->extraAttributes([
                        'style' => 'max-height: 256px; overflow-y: auto;',
                    ])
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255)
                    ->label('Описание'),
                Select::make('flow_id')
                    ->options(Flow::pluck('flow_name', 'id'))
                    ->dehydrated(false)
                    ->reactive()
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search): array => Flow::where('flow_name', 'like', "%{$search}%")
                        ->pluck('flow_name', 'id')
                        ->toArray()
                    )
                    ->label('Дисциплина'),
                Select::make('task_id')
                    ->options(function (callable $get) {
                        $flowId = $get('flow_id');
                        if ($flowId) {
                            return Task::where('flow_id', $flowId)
                                ->pluck('task_name', 'id');
                        }

                        return [];
                    })
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search, callable $get) {
                        $flowId = $get('flow_id');

                        return Task::where('task_name', 'like', "%{$search}%")
                            ->where('flow_id', $flowId)
                            ->pluck('task_name', 'id')
                            ->toArray();
                    })
                    ->getOptionLabelUsing(fn ($value): ?string => Task::find($value)?->task_name)
                    ->label('Задача'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team_name')
                    ->searchable()
                    ->label('Название'),
                TextColumn::make('team_description')
                    ->searchable()
                    ->label('Описание')
                    ->limit(20),
                TextColumn::make('tasks.task_name')
                    ->searchable()
                    ->label('Задача'),
                TextColumn::make('tasks.flows.max_team_size')
                    ->searchable()
                    ->sortable()
                    ->label('Макс. размер команды'),
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
