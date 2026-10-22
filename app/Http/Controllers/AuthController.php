<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function showLogin() {
        return view('login');
    }

    // 2. Memproses Data Login
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Bawa ke dashboard jika sukses
        }

        return back()->withErrors([
            'email' => 'Akses Ditolak: Email atau Password tidak valid.',
        ])->onlyInput('email');
    }

    // 3. Memproses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}