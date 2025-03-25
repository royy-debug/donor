<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipientResource\Pages;
use App\Models\Recipient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RecipientResource extends Resource
{
    protected static ?string $model = Recipient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->required(),

                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                Forms\Components\Select::make('blood_type')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),

                Forms\Components\TextInput::make('required_blood_bags')
                ->numeric()
                ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                    ])
                    ->default('waiting')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'primary' => 'waiting',
                        'success' => 'completed',
                        'danger' => 'canceled',
                    ]),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipients::route('/'),
            'create' => Pages\CreateRecipient::route('/create'),
            'edit' => Pages\EditRecipient::route('/{record}/edit'),
        ];
    }
}
