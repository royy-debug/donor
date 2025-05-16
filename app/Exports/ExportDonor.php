<?php

namespace App\Exports;

use App\Models\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Storage;

class ExportDonor implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Hanya field teks yang akan di-export
        return Donor::select('nik', 'name', 'gender', 'blood_type', 'phone', 'email', 'blood_count', 'status')->get();
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
            'Status',
        ];
    }
    public function map($row): array
{
    return [
        "'" .  $row->nik,
        $row->name,
        $row->gender,
        $row->blood_type,
        $row->phone,
        $row->email,
        $row->blood_count,
        $row->status,
    ];
}


    
}
