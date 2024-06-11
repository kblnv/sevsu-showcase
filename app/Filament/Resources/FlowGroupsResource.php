<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlowGroupsResource\Pages;
use App\Models\Flow;
use App\Models\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FlowGroupsResource extends Resource
{
    protected static ?string $model = Flow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Дисциплины - Группы';

    protected static ?string $pluralLabel = 'Дисциплины - Группы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('flow_id')
                    ->searchable()
                    ->options(Flow::pluck('flow_name', 'id'))
                    ->required()
                    ->label('Дисциплина'),
                Select::make('groups')
                    ->multiple()
                    ->required()
                    ->relationship('groups', 'gruop_name')
                    ->options(Group::pluck('group_name', 'id'))
                    ->label('Группы'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('flow_name')
                    ->label('Дисциплина'),
                TextColumn::make('groups.group_name')
                    ->badge()
                    ->limitList(1)
                    ->label('Группы'),
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
            'index' => Pages\ListFlowGroups::route('/'),
            'create' => Pages\CreateFlowGroups::route('/create'),
            'edit' => Pages\EditFlowGroups::route('/{record}/edit'),
        ];
    }
}
