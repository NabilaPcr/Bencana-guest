<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index()
    {
        return view('formlogin');
    }
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3|regex:/[A-Z]/',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.',
        ]);


        if ($request->username && $request->password) {

            return redirect('/berhasil')->with('pesan', 'Login berhasil! Halo, ' . $request->username);
        }


        return back()->with('pesan', 'Login gagal! Periksa kembali username dan password.');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
