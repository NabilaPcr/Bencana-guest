<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();

        // SEARCH - Mencria berdasarkan nama, NIK, atau alamat
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('telp', 'like', "%{$search}%");
            });
        }

        // FILTER - Filter berdasarkan jenis kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }


        // // SORTING -
        // $sort = $request->get('sort', 'created_at');
        // $order = $request->get('order', 'desc');
        // $query->orderBy($sort, $order);

        // PAGINATION - 12 data per halaman (sesuai grid layout)
        $warga = $query->paginate(12);

        // // Untuk menjaga filter saat pindah halaman
        // $warga->appends($request->all());

        return view('pages.warga.index', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'status_dampak' => 'required|in:korban,pengungsi,relawan,warga_biasa',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'status_kesehatan' => 'required|in:sehat,luka_ringan,luka_berat,meninggal',
        ]);

        Warga::create([
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'telp' => $request->telp,
            'status_dampak' => $request->status_dampak,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'status_kesehatan' => $request->status_kesehatan,
        ]);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.show', compact('warga'));
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'status_dampak' => 'required|in:korban,pengungsi,relawan,warga_biasa',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'status_kesehatan' => 'required|in:sehat,luka_ringan,luka_berat,meninggal',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update([
            'no_ktp' => $request->no_ktp,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'telp' => $request->telp,
            'status_dampak' => $request->status_dampak,

            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'status_kesehatan' => $request->status_kesehatan,
        ]);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diupdate.');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}
