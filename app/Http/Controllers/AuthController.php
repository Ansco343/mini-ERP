<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses Aksi Login
    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek kecocokan di database (Laravel otomatis membandingkan dengan password ter-Hash)
        if (Auth::attempt($credentials)) {
            // Jika sukses, regenerasi session id demi keamanan (Mencegah Session Fixation)
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Jika gagal, kembalikan dengan pesan error di field email
        return back()->withErrors([
            'email' => 'Email atau Password yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Form Register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Aksi Registrasi Akun Baru
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed' // Butuh input password_confirmation
        ]);

        // Buat User Baru dengan enkripsi password (Hash)
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // Proses Logout Akun
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Buat ulang CSRF token baru
        return redirect()->route('login');
    }
}
