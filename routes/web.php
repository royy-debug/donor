<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonorPreScreenController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDonor;
use App\Http\Controllers\BloodStockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Rute aplikasi Blood Donor
*/

// 🔹 Landing Page (Public)
Route::get('/', [BloodStockController::class, 'index'])->name('utama');

// 🔹 Auth (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
});

// 🔹 Public Pages
Route::view('informasi-terkini', 'informasi')->name('informasi');
Route::view('contact', 'contact')->name('contact');

// 🔹 Protected (Authenticated)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', function () {
        auth()->logout();
        return redirect()->route('utama');
    })->name('logout');

    // Pre-Screening Donor
    Route::prefix('donor')->name('donor.')->group(function () {
        Route::get('pre-screen', [DonorPreScreenController::class, 'showForm'])->name('prescreen.form');
        Route::post('pre-screen', [DonorPreScreenController::class, 'submitForm'])->name('prescreen.submit');
    });

    // Donate route (after prescreen)
    Route::get('donate', [DonorPreScreenController::class, 'handleDonate'])->name('donate');

    // ↓ Export Data Donor
    Route::get('donors/export', function () {
        return Excel::download(new ExportDonor, 'donors.xlsx');
    })->name('donors.export');
});

// 🔹 Fallback 404
Route::fallback(fn() => view('errors.404'));
