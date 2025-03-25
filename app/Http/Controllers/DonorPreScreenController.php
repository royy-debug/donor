<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class DonorPreScreenController extends Controller
{
    public function showForm()
    {
        return view('donor.pre_screening_form');
    }

    public function submitForm(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'blood_type' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'weight' => 'required|numeric|min:45',
            'address' => 'required',
            'blood_count' => 'required|numeric|min:100|max:500',
            'ktp_file' => 'required|image|max:2048',
            'is_healthy' => 'required|in:0,1',
            'has_disease_history' => 'required|in:0,1',
            'slept_well' => 'required|in:0,1'

        ]);

        // Cek pre-screening validasi secara logika (optional)
        if (!$validated['is_healthy'] || $validated['has_disease_history'] || !$validated['slept_well']) {
            return back()->withErrors(['msg' => 'Maaf, Anda tidak memenuhi syarat donor darah.'])->withInput();
        }
        
        $ktpPath = $request->file('ktp_file')->store('ktp_files', 'public');


        // Simpan ke tabel donors
        $donor = Donor::create([
            'name' => $validated['name'],
            'gender' => $validated['gender'], // jangan lupa, gender juga nggak masuk tadi
            'blood_type' => $validated['blood_type'],
            'phone' => $validated['phone'],
            'email' => $validated['email'], // <-- tambahin ini
            'address' => $validated['address'], // <-- benerin typo
            'weight' => $validated['weight'],
            'blood_count' => $validated['blood_count'],
            'ktp_file' => $ktpPath, // nanti gua jelasin
            'is_healthy' => $validated['is_healthy'],
            'has_disease_history' => $validated['has_disease_history'],
            'slept_well' => $validated['slept_well'],
        ]);

        // Generate QR Code (dari ID donor misalnya)
        $qrData = json_encode([
            'id' => $donor->id,
            'name' => $donor->name,
            'blood_type' => $donor->blood_type,
        ]);

        $qrCode = QrCode::size(250)->generate($qrData);

        return view('donor.pre_screening_success', [
            'donor' => $donor,
            'qrCode' => $qrCode,
        ]);
    }
}
