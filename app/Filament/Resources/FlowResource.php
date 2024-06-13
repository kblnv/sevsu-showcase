<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlowResource\Pages;
use App\Models\Flow;
use Carbon\Carbon;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FlowResource extends Resource
{
    protected static ?string $model = Flow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Дисциплины';

    protected static ?string $pluralLabel = 'Дисциплины';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('flow_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Название дисциплины'),
                TextInput::make('max_team_size')
                    ->required()
                    ->rules('gt:0')
                    ->validationMessages([
                        'gt' => 'Значение :attribute должно быть больше 0.',
                    ])
                    ->label('Макс. размер команды'),
                DateTimePicker::make('take_before')
                    ->required()
                    ->label('Начало командооборазования'),
                DateTimePicker::make('finish_before')
                    ->required()
                    ->label('Конец командооборазования'),
                Checkbox::make('can_create_task')
                    ->default(0)
                    ->label('Можно создавать свои команды'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('flow_name')
                    ->searchable()
                    ->label('Дисциплина'),
                TextColumn::make('take_before')
                    ->sortable()
                    ->label('Начало командооборазования'),
                TextColumn::make('finish_before')
                    ->sortable()
                    ->label('Конец командооборазования'),
                TextColumn::make('max_team_size')
                    ->label('Макс. размер команды'),
                CheckboxColumn::make('can_create_task')
                    ->label('Можно создавать свои команды'),
            ])
            ->filters([
                Filter::make('take_before')
                    ->form([
                        DatePicker::make('take_before')
                            ->label('Начало командооборазования'),
                        DatePicker::make('finish_before')
                            ->label('Конец командооборазования'),
                    ])
                    ->indicateUsing(function (array $data) {
                        $indicators = [];

                        if (isset($data['take_before'])) {
                            $indicators[] = Indicator::make('Начало командообразования: '.Carbon::parse($data['take_before'])->locale('ru')->isoFormat('D MMMM YYYY'))
                                ->removeField('take_before');
                        }

                        if (isset($data['finish_before'])) {
                            $indicators[] = Indicator::make('Конец командообразования: '.Carbon::parse($data['finish_before'])->locale('ru')->isoFormat('D MMMM YYYY'))
                                ->removeField('finish_before');
                        }

                        return $indicators;
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['take_before'],
                                fn (Builder $query, $date): Builder => $query->whereDate('take_before', '>=', $date),
                            )
                            ->when(
                                $data['finish_before'],
                                fn (Builder $query, $date): Builder => $query->whereDate('finish_before', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListFlows::route('/'),
            'create' => Pages\CreateFlow::route('/create'),
            'edit' => Pages\EditFlow::route('/{record}/edit'),
        ];
    }
}
