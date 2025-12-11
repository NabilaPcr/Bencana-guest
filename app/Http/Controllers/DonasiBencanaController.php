<?php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;

class DonasiBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasi = DonasiBencana::with('kejadian')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.donasi.index', compact('donasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kejadianList = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi.create', compact('kejadianList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis' => 'required|in:uang,barang',
            'nilai' => 'required|numeric|min:0',
        ]);

        DonasiBencana::create($validated);

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DonasiBencana $donasiBencana)
    {
        return view('pages.donasi.show', compact('donasiBencana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonasiBencana $donasiBencana)
    {
        $kejadianList = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi.edit', compact('donasiBencana', 'kejadianList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonasiBencana $donasiBencana)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis' => 'required|in:uang,barang',
            'nilai' => 'required|numeric|min:0',
        ]);

        $donasiBencana->update($validated);

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonasiBencana $donasiBencana)
    {
        $donasiBencana->delete();

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil dihapus!');
    }
}
