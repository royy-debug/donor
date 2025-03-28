<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonorPreScreenController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDonor;

// 🔹 Halaman Landing Page
Route::get('/', [DashboardController::class, 'index'])->name('utama');

// 🔹 Halaman Register & Login
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🔹 Halaman Informasi & Kontak
Route::get('/informasi-terkini', function () {
    return view('informasi');
})->name('informasi');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// 🔹 Rute Donor (Pre-Screening) dengan Middleware Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/donor/pre-screening', [DonorPreScreenController::class, 'showForm'])->name('donor.prescreen.form');
    Route::post('/donor/pre-screening', [DonorPreScreenController::class, 'submitForm'])->name('donor.prescreen.submit');
});

// 🔹 Export Data Donor
Route::get('/donors/export', function () {
    return Excel::download(new ExportDonor, 'donors.xlsx');
})->name('donors.export');

// 🔹 Tombol "Donate Now" - Cek Login Dulu
Route::get('/donate', function () {
    return auth()->check() 
        ? redirect()->route('donor.prescreen.form') 
        : redirect()->route('login');
})->name('donate');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect ke halaman utama setelah logout
})->name('logout');

// Route::get('/check-role', function () {
//     $user = User::find(2); // atau user mana aja yang udah ada role-nya
    
//     dd([
//         'roles' => $user->getRoleNames(), // list role-nya
//         'has_super_admin' => $user->hasRole('super_admin'), // true / false
//         'has_staf' => $user->hasRole('staf'), // true / false
//     ]);
// });