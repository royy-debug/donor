<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorPreScreenController;
use App\Http\Controllers\ExportController;
use App\Exports\DonorsExport;
use App\Exports\ExportDonor;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


// FORM REGISTER
// Route::get('/register', function () {
//     return view('register.register'); // View ada di resources/views/login/register.blade.php
// })->name('register');

// FORM LOGIN
// Route::get('/login', function () {
//     return view('register.login'); // View ada di resources/views/login/login.blade.php
// })->name('login');

// routes/web.php





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute-rute ini otomatis pake middleware "web" karena lo masukin di
| routes/web.php, jadi session, CSRF, dll. aman.
|
*/

// Halaman register + submit register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Halaman login + proses login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Logout (wajib POST biar aman)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ✅ Dashboard atau landing setelah login (ADMIN)

// ✅ Dashboard user biasa
// Route::get('/utama', function () {
//     return view('user.dashboard');
// })->middleware(['auth'])->name('user.dashboard');



// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
// Route::get('/utama', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->name('utama');

Route::middleware(['web'])->group(function () {
    Route::get('/donor/pre-screening', [DonorPreScreenController::class, 'showForm'])->name('donor.prescreen.form');
    Route::post('/donor/pre-screening', [DonorPreScreenController::class, 'submitForm'])->name('donor.prescreen.submit');
});

Route::get('/informasi-terkini', function () {
    return view('informasi');
})->name('informasi');
Route::get('/donors/export', function () {
    return Excel::download(new ExportDonor, 'donors.xlsx');
});

// Route::get('/check-role', function () {
//     $user = User::find(2); // atau user mana aja yang udah ada role-nya
    
//     dd([
//         'roles' => $user->getRoleNames(), // list role-nya
//         'has_super_admin' => $user->hasRole('super_admin'), // true / false
//         'has_staf' => $user->hasRole('staf'), // true / false
//     ]);
// });