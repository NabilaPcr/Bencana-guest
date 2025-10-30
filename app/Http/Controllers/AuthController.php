<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller {
    public function index()
    {
    return view('formlogin');
    }
    public function login(Request $request)
    {
     $request->validate([
            'email' => 'required|email', // Ubah dari username ke email
            'password' => 'required',
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        // Jika email ditemukan, cek password dengan Hash::check
        if ($user && Hash::check($request->password, $user->password)) {
            // Login berhasil
            auth()->login($user);
            return redirect('/dashboard')->with('success', 'Login berhasil!');
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
