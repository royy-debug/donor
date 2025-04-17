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
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            

            if ($user && $user->hasRole('super_admin')){
                return redirect()->intended('/admin');  // ➡️ Admin Panel
            }
            if ($user && $user->hasRole('staf')){
                return redirect()->intended('/admin');  // ➡️ Admin Panel
            }

            // Kalau user biasa
            return redirect()->intended('/');  // ➡️ Dashboard user biasa
        }

        // Kalau gagal login
        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
