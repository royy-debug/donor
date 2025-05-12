<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ← Ini!


class DashboardController extends Controller
{
    public function index()
    {
        $stok = DB::table('donors')
            ->select('blood_type', DB::raw('SUM(blood_count) as total_darah'))
            ->groupBy('blood_type')
            ->get();
    
        return view('pages.home', compact('stok'));
    }
}    