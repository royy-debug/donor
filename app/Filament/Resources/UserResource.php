<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group'; // icon opsional

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
    
                TextInput::make('email')
                    ->email()
                    ->required(),
    
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state)),
    
                    Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->options(Role::all()->pluck('name', 'id'))
                    ->preload()
                    ->afterStateHydrated(function ($set, $record) {
                        if (!$record) {
                            return;
                        }
                        $set('roles', $record->roles()->pluck('id')->toArray());
                    }),
                    // CheckboxList::make('permissions')
                    // ->label('Permissions')
                    // ->options(Permission::pluck('name', 'id'))
                    // ->columns(2)
                    // ->afterStateHydrated(function ($set, $record) {
                    //     if (!$record) return;
                
                    //     $set('permissions', $record->permissions()->pluck('id')->toArray());
                    // }),
                    // Sama, jangan syncPermissions di afterStateUpdated, mending di afterSave!
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                
            
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
