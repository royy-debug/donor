<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonorResource\Pages;
use App\Models\Donor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use App\Exports\ExportDonor;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Filament\Facades\Filament;


class DonorResource extends Resource 
{
    protected static ?string $model = Donor::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Management';

    
    // BISA LIAT LIST?
    // public static function canViewAny(): bool
    // {
    //     $user = Filament::auth()->user();
    //     if (!$user) {
    //         \Log::info('User null');
    //         return false;
    //     }
    
    //     \Log::info('User info', [
    //         'user' => $user->toArray(),
    //         'roles' => $user->getRoleNames()
    //     ]);
    
    //     return $user->hasAnyRole(['Admin', 'Staff']);
    // }
    

    // BISA BUAT DATA BARU?
    // public static function canCreate(): bool
    // {
    //     return Filament::auth()->user()->hasRole('Admin');
    // }

    // // BISA LIHAT DETAIL DATA?
    // public static function canView($record): bool
    // {
    //     return Filament::auth()->user()->hasAnyRole(['Admin', 'Staff']);
    // }

    // // BISA EDIT?
    // public static function canEdit($record): bool
    // {
    //     return Filament::auth()->user()->hasAnyRole(['Admin', 'Staff']);
    // }

    // // BISA HAPUS?
    // public static function canDelete($record): bool
    // {
    //     return Filament::auth()->user()->hasRole('Admin');
    // }
    // public static function canViewAny(): bool
    // {
    //     $user = Filament::auth()->user();
    
    //     dd($user); // Cek isi user yang login
    
    //     return $user->can('view-user');
    // }
    
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pendonor')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\Select::make('gender')
                            ->options(['M' => 'Male', 'F' => 'Female'])->required(),
                        Forms\Components\Select::make('blood_type')
                            ->options(['A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O'])->required(),
                        Forms\Components\TextInput::make('phone')->tel()->required(),
                        Forms\Components\TextInput::make('email')->email()->required(),
                        Forms\Components\Textarea::make('address')->nullable(),
                        Forms\Components\TextInput::make('weight')->numeric()->nullable(),
                        Forms\Components\TextInput::make('blood_count')
                            ->label('Jumlah Darah (ml)')
                            ->numeric()
                            ->required()
                            ->default(450),
                    ]),
    
                Forms\Components\Section::make('Pre-Screening Kesehatan')
                    ->schema([
                        Forms\Components\Select::make('is_healthy')
                            ->options([1 => 'Ya', 0 => 'Tidak'])
                            ->required(),
                        Forms\Components\Select::make('has_disease_history')
                            ->options([1 => 'Ada', 0 => 'Tidak Ada'])
                            ->required(),
                        Forms\Components\Select::make('slept_well')
                            ->options([1 => 'Ya', 0 => 'Tidak'])
                            ->required(),
                        
                    ]),
    
                Forms\Components\Section::make('Upload Berkas')
                    ->schema([
                        Forms\Components\FileUpload::make('ktp_file')
                            ->label('Upload KTP')
                            ->directory('ktp-files')
                            ->disk('public')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->nullable(),
                    ]),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('blood_count')
                ->label('Jumlah Darah (ml)'),
                Tables\Columns\ImageColumn::make('ktp_file')
                ->label('KTP')
                ->disk('public') // tambahin disk sesuai config kamu
                ->circular() // atau ->square()
                
                ->url(fn ($record) => asset('storage/' . $record->ktp_file)),
                
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('show_qr')
                ->label('QR Code')
                ->icon('heroicon-o-qr-code')
                ->action(function ($record, $data) {
                    // Ga ngapa2in di sini karena cuma buat pop-up modal
                })
                ->modalHeading('QR Code Donor')
                ->modalContent(function ($record) {
                    $qrCodeSvg = QrCode::size(250)
                        ->generate('Donor ID: ' . $record->id . ' | Nama: ' . $record->name . ' | Blood_type: ' . $record->blood_type);

                    return view('qr-modal', ['qrCode' => $qrCodeSvg]);
                })
                ->modalSubmitAction(false), 
            ])
            ->headerActions([
                Action::make('Export Excel')
                    ->action(fn () => Excel::download(new ExportDonor, 'donors.xlsx'))
                    ->label('Export Excel')
                    ->color('primary'),
            ])
            // ->filters([
            //     SelectFilter::make('donor_id')
            //     ->options(Donor)
            // ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonors::route('/'),
            'create' => Pages\CreateDonor::route('/create'),
            'edit' => Pages\EditDonor::route('/{record}/edit'),
        ];
    }

    public static function generateQrCode(Donor $donor)
    {
        $qrData = json_encode([
            'donor_id' => $donor->id,
            'name' => $donor->name,
            'blood_type' => $donor->blood_type,
            'status' => $donor->status,
        ]);

        $filePath = 'qr-codes/donor-' . $donor->id . '.png';
        Storage::disk('public')->put($filePath, QrCode::format('png')->size(300)->generate($qrData));

        $donor->update(['qr_code' => $filePath]);
    }
}
