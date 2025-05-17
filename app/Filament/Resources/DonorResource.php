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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonorResource extends Resource
{
    protected static ?string $model = Donor::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Pendonor')
                    ->schema([
                        Forms\Components\TextInput::make('nik')->required(),
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\Select::make('gender')
                            ->options(['M' => 'Male', 'F' => 'Female'])->required(),
                        Forms\Components\Select::make('blood_type')
                            ->options(['A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O'])->required(),
                        Forms\Components\TextInput::make('phone')->tel()->required(),
                        Forms\Components\TextInput::make('email')
                            ->default(fn() => auth()->user()->email)
                            ->disabled()
                            ->required(),
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn() => auth()->id()),
                        Forms\Components\TextInput::make('weight')->numeric()->nullable(),
                        Forms\Components\TextInput::make('blood_count')
                            ->label('Jumlah Darah (ml)')
                            ->numeric()
                            ->required()
                            ->default(450),
                        // status pendonor
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending'  => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Pre-Screening Kesehatan')
                    ->schema([
                        Forms\Components\Select::make('is_healthy')
                            ->label('Sehat')
                            ->options([1 => 'Ya', 0 => 'Tidak'])
                            ->required(),
                        Forms\Components\Select::make('has_disease_history')
                            ->label('Riwayat Penyakit')
                            ->options([1 => 'Ada', 0 => 'Tidak Ada'])
                            ->required(),
                        Forms\Components\Select::make('slept_well')
                            ->label('Tidur Cukup')
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

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('blood_count')->label('Jumlah Darah (ml)'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning'  => 'pending',
                        'success'  => 'approved',
                        'danger'   => 'rejected',
                    ])
                    ->sortable(),
                Tables\Columns\ImageColumn::make('ktp_file')
                    ->label('KTP')
                    ->disk('public')
                    ->circular()
                    ->url(fn($record) => asset('storage/' . $record->ktp_file)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // custom action approve
                Action::make('approve')
                    ->label('Approve')
                    ->action(fn(Donor $record) => $record->update(['status' => 'approved']))
                    ->requiresConfirmation()
                    ->visible(fn(Donor $record) => $record->status === 'pending'),
                // custom action reject
                Action::make('reject')
                    ->label('Reject')
                    ->action(fn(Donor $record) => $record->update(['status' => 'rejected']))
                    ->requiresConfirmation()
                    ->color('danger')
                    ->visible(fn(Donor $record) => $record->status === 'pending'),
                Tables\Actions\Action::make('show_qr')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->action(function ($record) {
                        // no action
                    })
                    ->modalHeading('QR Code Donor')
                    ->modalContent(fn($record) => view('qr_modal', [
                        'qrCode' => QrCode::size(250)
                            ->generate("Donor ID: {$record->id} | NIK: {$record->nik} | Nama: {$record->name} |  Status: {$record->status}"),
                    ]))
                    ->modalSubmitAction(false),
            ])
            ->headerActions([
                Action::make('Export Excel')
                    ->action(fn() => Excel::download(new ExportDonor(), 'donors.xlsx'))
                    ->label('Export Excel')
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('bulkApprove')
                    ->label('Approve Selected')
                    ->action(fn($records) => $records->each->update(['status' => 'approved']))
                    ->requiresConfirmation(),
                Tables\Actions\BulkAction::make('bulkReject')
                    ->label('Reject Selected')
                    ->action(fn($records) => $records->each->update(['status' => 'rejected']))
                    ->requiresConfirmation(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDonors::route('/'),
            'create' => Pages\CreateDonor::route('/create'),
            'edit'   => Pages\EditDonor::route('/{record}/edit'),
        ];
    }

    /**
     * Generate and store QR code image, update donor record
     */
    public static function generateQrCode(Donor $donor)
    {
        $qrData = json_encode([
            'donor_id'   => $donor->id,
            'name'       => $donor->name,
            'blood_type' => $donor->blood_type,
            'status'     => $donor->status,
        ]);

        $filePath = 'qr-codes/donor-' . $donor->id . '.png';
        Storage::disk('public')
            ->put($filePath, QrCode::format('png')->size(300)->generate($qrData));

        $donor->update(['qr_code' => $filePath]);
    }
}
