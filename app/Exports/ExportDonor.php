<?php

namespace App\Exports;

use App\Models\Donor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDonor implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Donor::all([
            'id',
            'name',
            'email',
            'blood_type',
            'phone',
            'blood_count',
            'address',
            'weight',

            
        ]);
    }

    public function headings(): array
    {
        return [
           'ID',
            'Name',
            'Email',
            'Blood_type',
            'Phone',
            'Blood_count',
            'Address',
            'Weight',
        ];
    }
}
