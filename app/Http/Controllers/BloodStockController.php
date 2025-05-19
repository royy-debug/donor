<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Models\StokDarah;

class BloodStockController extends Controller
{

public function index()
    {
        $golonganDarah = ['A', 'B', 'AB', 'O'];

        $stok = Donor::select('blood_type')
            ->selectRaw('SUM(blood_count) as total_darah')
            ->groupBy('blood_type')
            ->get()
            ->keyBy('blood_type');

        $stokLengkap = collect($golonganDarah)->map(fn ($gol) => (object)[
            'blood_type' => $gol,
            'total_darah' => $stok[$gol]->total_darah ?? 0
        ]);

        return view('pages.home', [
            'stok' => $stokLengkap
        ]);
    }

}
