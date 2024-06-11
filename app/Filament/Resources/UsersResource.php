<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsersResource\Pages;
use App\Models\Group;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Пользователи';

    protected static ?string $pluralLabel = 'Пользователи';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('second_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->label('Имя'),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Отчетство'),
                TextColumn::make('group.group_name')
                    ->label('Группа'),
            ])
            ->filters([
                Filter::make('group_id')
                    ->form([
                        Select::make('group_id')
                            ->searchable()
                            ->options(Group::pluck('group_name', 'id'))
                            ->label('Группа'),
                    ])
                    ->indicateUsing(function (array $data) {
                        if ($data['group_id']) {
                            $group = Group::find($data['group_id']);

                            return $group->group_name;
                        }

                    })
                    ->query(function (Builder $query, array $data) {
                        if ($data['group_id']) {
                            return $query->where('group_id', $data['group_id']);
                        }

                        return $query;
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUsers::route('/create'),
            // 'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
