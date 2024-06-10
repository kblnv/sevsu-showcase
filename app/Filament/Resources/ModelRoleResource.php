<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModelRoleResource\Pages;
use App\Filament\Resources\ModelRoleResource\RelationManagers;
use App\Models\ModelRole;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModelRoleResource extends Resource
{
    protected static ?string $model = ModelRole::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Права';

    protected static ?string $navigationLabel = 'Управление ролями';

    protected static ?string $pluralLabel = 'Управление ролями';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('model_id')
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
                Select::make('role_id')
                    ->searchable()
                    ->options(function (callable $get) {
                        $userId = $get('model_id');
                        if ($userId) {
                            $assignedRoles = ModelRole::where('model_id', $userId)
                                                ->pluck('role_id')
                                                ->toArray();
                            $unassignedRoles = Role::whereNotIn('uuid', $assignedRoles)
                                                ->pluck('name', 'uuid');
                            return $unassignedRoles;
                        }
                        return [];
                    })
                    ->required()
                    ->getOptionLabelUsing(fn ($value): ?string => Role::find($value)?->name)
                    ->label('Роль'),
                Hidden::make('model_type')->default('App\Models\User'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('models.second_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                TextColumn::make('models.first_name')
                    ->label('Имя'),
                TextColumn::make('models.last_name')
                    ->label('Отчество'),
                TextColumn::make('roles.name')
                    ->label('Роль'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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

    public static function getResource(): ?string
    {
        return ModelRole::class;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModelRoles::route('/'),
            'create' => Pages\CreateModelRole::route('/create'),
            // 'edit' => Pages\EditModelRole::route('/{record}/edit'),
        ];
    }
}
