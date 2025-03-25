<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Filament\Resources\DonationResource\Widgets\StatsOverview;
use App\Models\Donation;
use App\Models\Donor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Concerns\ToArray;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Management';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('donor_id')
                ->relationship('donor', 'name')
                ->required(),
                Forms\Components\Select::make('recipient_id')
                ->relationship('recipient', 'name')
                ->required(),
                Forms\Components\DatePicker::make('donor_date')
                ->required(),
                Forms\Components\TextInput::make('blood_count')
                ->label('Jumlah Darah (ml)')
                ->numeric() // Pastikan input hanya angka
                ->default(0)
                ->rules(['regex:/^\d+(\.\d{1,2})?$/']) // Validasi agar sesuai format decimal
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('donor_id'),
                Tables\Columns\TextColumn::make('donor_date'),
                Tables\Columns\TextColumn::make('blood_count')->label('jumlah_darah')
            ])
            ->filters([
                SelectFilter::make('donor_id')
                ->options(Donor::pluck('name', 'id'))
            ])
           
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    // public static function getWidgets(): array
    // {
    //     return[
    //         StatsOverview::class
    //     ];
    // }
    
}
