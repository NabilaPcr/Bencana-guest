<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        return view('pages.auth.formlogin');
    }

    // Proses login
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user(); //digunakan agar pengguna dapat login

        // Redirect berdasarkan role
        if ($user->role === 'Super Admin') {
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang Super Admin!');
        } elseif ($user->role === 'Mitra') {
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang Mitra!');
        } else {
            // Untuk Pelanggan, redirect ke halaman khusus
            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang!');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}
    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout(); //mengeluarkan pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth')->with('success', 'Anda telah logout.');
    }
}
