<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('auth.index')
                ->withErrors('Silahkan login terlebih dahulu!');
        }

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // CEK: Jika user adalah "Pelanggan" atau "Mitra", mereka TIDAK BOLEH akses dashboard
        // Hanya Super Admin yang boleh akses dashboard admin
        if (in_array($user->role, ['Pelanggan', 'Mitra'])) {
            // Redirect mereka ke halaman khusus untuk role mereka
            // Atau tampilkan error 403

            // Pilihan 1: Redirect ke halaman khusus
            // return redirect()->route('user.dashboard'); // Buat route ini khusus untuk user biasa

            // Pilihan 2: Tampilkan error 403
            return abort(403, 'Anda tidak memiliki akses ke dashboard admin. Hubungi Super Admin.');
        }

        return $next($request);
    }
}
