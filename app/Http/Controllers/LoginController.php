<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('register.login'); // tampilin halaman login
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Email atau Password salah.']);
    }

    $request->session()->regenerate();
    $user = Auth::user();

    // **Debug role** kalau masih bingung
    // dd($user->getRoleNames());

    // Redirect tanpa “intended”
    if ($user->hasRole('super_admin') || $user->hasRole('staf')) {
        return redirect()->to('/admin');             // ➡️ Admin Panel
        // atau: return redirect()->route('admin.dashboard');
    }
    return redirect('/');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
