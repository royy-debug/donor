<?php

namespace App\Exports;

use App\Models\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Storage;

class ExportDonor implements FromCollection, WithHeadings, WithDrawings
{
    public function collection()
    {
        // Hanya field teks yang akan di-export
        return Donor::select('nik', 'name', 'gender', 'blood_type', 'phone', 'email', 'blood_count')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Gender',
            'Golongan Darah',
            'No HP',
            'Email',
            'Jumlah Darah (ml)',
        ];
    }

    public function drawings()
    {
        $drawings = [];

        $donors = Donor::all();
        $rowIndex = 2; // Karena baris 1 adalah heading

        foreach ($donors as $donor) {
            if ($donor->ktp_file && Storage::disk('public')->exists($donor->ktp_file)) {
                $drawing = new Drawing();
                $drawing->setName('KTP');
                $drawing->setDescription('Foto KTP');
                $drawing->setPath(storage_path('app/public/' . $donor->ktp_file)); // path ke file
                $drawing->setHeight(80);
                $drawing->setCoordinates('H' . $rowIndex); // Kolom H (gambar di kolom setelah data teks)

                $drawings[] = $drawing;
            }
            $rowIndex++;
        }

        return $drawings;
    }
}
