<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserTeamResource\Pages;
use App\Filament\Resources\UserTeamResource\RelationManagers;
use App\Models\Group;
use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserTeamResource extends Resource
{
    protected static ?string $model = UserTeam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Таблицы';

    protected static ?string $navigationLabel = 'Пользователи';

    protected static ?string $pluralLabel = 'Пользователи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('team_id')
                    ->options(Team::pluck('team_name', 'id'))
                    ->label('Команда'),
                Select::make('user_id')
                    ->searchable()
                    ->options(function () {
                        return User::select('id', 'first_name', 'second_name', 'last_name')
                                    ->get()
                                    ->mapWithKeys(function ($user) {
                                        return [$user->id => $user->second_name . ' ' . $user->first_name . ' ' . $user->last_name];
                                    });
                    })
                    ->required()
                    ->label('ФИО'),
                Checkbox::make('is_moderator')
                    ->default(0)
                    ->label('Модератор'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.second_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                TextColumn::make('users.first_name')
                    ->searchable()
                    ->sortable()
                    ->label('Имя'),
                TextColumn::make('users.last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Отчетство'),
                TextColumn::make('users.group.group_name')
                    ->label('Группа'),
                TextColumn::make('teams.team_name')
                    ->searchable()
                    ->sortable()
                    ->label('Команда'),
                CheckboxColumn::make('is_moderator')
                    ->default(0)
                    ->label('Модератор'),
            ])
            ->filters([
                Filter::make('team_id')
                    ->form([
                        Select::make('team_id')
                            ->searchable()
                            ->options(Team::pluck('team_name', 'id'))
                            ->label('Команда'),
                    ])
                    ->indicateUsing(function (array $data) {
                        if ($data['team_id']) {
                            $team = Team::find($data['team_id']);
                            return $team->team_name;
                        }
                        return;
                    })
                    ->query(function (Builder $query, array $data) {
                        if ($data['team_id']) {
                            return $query->where('team_id', $data['team_id']);
                        }
                        return $query;
                    }),
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
                            return;
                        })
                        ->query(function (Builder $query, array $data) {
                            if ($data['group_id']) {
                                return $query->whereHas('users', function (Builder $query) use ($data) {
                                    $query->where('group_id', $data['group_id']);
                                });
                            }
                            return $query;
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
            'index' => Pages\ListUserTeams::route('/'),
            'create' => Pages\CreateUserTeam::route('/create'),
            'edit' => Pages\EditUserTeam::route('/{record}/edit'),
        ];
    }
}
