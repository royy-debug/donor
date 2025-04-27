<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Events\DonorCreated;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;

class DonorPreScreenController extends Controller
{
    public function showForm()
    {
        // user pasti sudah login karena middleware
        $user = Auth::user();
        return view('donor.pre_screening_form', compact('user'));
    }

    public function submitForm(Request $request)
    {
        // Validasi input (tanpa email, tanpa nik & name saja)
        $validated = $request->validate([
            'nik'                 => 'required',
            'name'                => 'required',
            'gender'              => 'required',
            'blood_type'          => 'required',
            'phone'               => 'required',
            'weight'              => 'required|numeric|min:45',
            'blood_count'         => 'required|numeric|min:100|max:500',
            'ktp_file'            => 'required|image|max:2048',
            'is_healthy'          => 'required|in:0,1',
            'has_disease_history' => 'required|in:0,1',
            'slept_well'          => 'required|in:0,1',
        ]);

        if (! $validated['is_healthy'] || $validated['has_disease_history'] || ! $validated['slept_well']) {
            return back()
                ->withErrors(['msg' => 'Maaf, Anda tidak memenuhi syarat donor darah.'])
                ->withInput();
        }

        $ktpPath = $request->file('ktp_file')->store('ktp_files', 'public');

        // Siapkan data untuk disimpan
        $data = array_merge($validated, [
            'ktp_file' => $ktpPath,
            'user_id'  => Auth::id(),
            'email'    => Auth::user()->email,
        ]);

        $donor = Donor::create($data);

        event(new DonorCreated($donor));

        // Generate QR Code
        $qrData = json_encode([
            'id'         => $donor->id,
            'name'       => $donor->name,
            'blood_type' => $donor->blood_type,
        ]);
        $qrCode = QrCode::size(250)->generate($qrData);

        return view('donor.pre_screening_success', [
            'donor'  => $donor,
            'qrCode' => $qrCode,
        ]);
    }

    public function handleDonate()
    {
        $user = Auth::user();

        $donor = Donor::where('user_id', $user->id)->first();

        if ($donor) {
            $qrData = json_encode([
                'id'         => $donor->id,
                'name'       => $donor->name,
                'blood_type' => $donor->blood_type,
            ]);
            $qrCode = QrCode::size(250)->generate($qrData);

            return view('donor.pre_screening_success', [
                'donor'  => $donor,
                'qrCode' => $qrCode,
            ]);
        }

        return redirect()->route('donor.prescreen.form');
    }
}
