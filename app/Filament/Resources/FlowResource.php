<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlowResource\Pages;
use App\Filament\Resources\FlowResource\RelationManagers;
use App\Models\Flow;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlowResource extends Resource
{
    protected static ?string $model = Flow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('flow_name')
                    ->required()
                    ->label('Название дисциплины'),
                TextInput::make('max_team_size')
                    ->required()
                    ->inputMode('decimal')
                    ->label('Максимальный размер команды'),
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
                TextColumn::make('flow_name')->searchable()->label('Дисциплина'),
                TextColumn::make('take_before')->sortable()->label('Начало командооборазования'),
                TextColumn::make('finish_before')->sortable()->label('Конец командооборазования'),
                TextColumn::make('max_team_size')->label('Максимальный размер команды'),
                CheckboxColumn::make('can_create_task')->label('Можно создавать свои команды'),
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
            'index' => Pages\ListFlows::route('/'),
            'create' => Pages\CreateFlow::route('/create'),
            'edit' => Pages\EditFlow::route('/{record}/edit'),
        ];
    }
}
