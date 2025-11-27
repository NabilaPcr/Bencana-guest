<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;

class PoskoController extends Controller
{
  public function index(Request $request)
{
    $query = PoskoBencana::with('kejadian');

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%')
              ->orWhere('penanggung_jawab', 'like', '%' . $search . '%')
              ->orWhere('alamat', 'like', '%' . $search . '%')
              ->orWhere('kontak', 'like', '%' . $search . '%')
              ->orWhereHas('kejadian', function($q) use ($search) {
                  $q->where('jenis_bencana', 'like', '%' . $search . '%')
                    ->orWhere('lokasi_text', 'like', '%' . $search . '%');
              });
        });
    }

    // Filter by jenis bencana (bukan kejadian_id)
    if ($request->has('jenis_bencana') && $request->jenis_bencana != '') {
        $query->whereHas('kejadian', function($q) use ($request) {
            $q->where('jenis_bencana', $request->jenis_bencana);
        });
    }

    $poskoBencana = $query->paginate(5);

    // Ambil semua jenis bencana yang UNIK
    $jenisBencanaList = KejadianBencana::distinct()
        ->pluck('jenis_bencana')
        ->sort();

    return view('pages.posko.index', compact('poskoBencana', 'jenisBencanaList'));
}

    public function create()
    {
        $kejadianList = KejadianBencana::all();
        return view('pages.posko.create', compact('kejadianList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posko_id'         => 'required|unique:posko_bencana,posko_id',
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string',
            // 'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak'           => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            // 'media'            => 'nullable|string',
        ]);

        // $fotoPath = null;
        // if ($request->hasFile('foto')) {
        //     $fotoPath = $request->file('foto')->store('posko_fotos', 'public');
        // }

        PoskoBencana::create([
            'posko_id'         => $request->posko_id,
            'kejadian_id'      => $request->kejadian_id,
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            // 'foto'             => $fotoPath,
            'kontak'           => $request->kontak,
            'penanggung_jawab' => $request->penanggung_jawab,
            // 'media'            => $request->media,
        ]);

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil ditambahkan.');
    }

    public function show($id)
    {
        $posko = PoskoBencana::with('kejadian')->findOrFail($id);
        return view('pages.posko.show', compact('posko'));
    }

    public function edit($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $kejadianList = KejadianBencana::all();

        return view('pages.posko.edit', compact('posko', 'kejadianList'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string',
            // 'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak'           => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            // 'media'            => 'nullable|string',
        ]);

        $posko = PoskoBencana::findOrFail($id);

        if ($request->hasFile('foto')) {
            $fotoPath    = $request->file('foto')->store('posko_fotos', 'public');
            $posko->foto = $fotoPath;
        }

        $posko->update([
            'kejadian_id'      => $request->kejadian_id,
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            'kontak'           => $request->kontak,
            'penanggung_jawab' => $request->penanggung_jawab,
            // 'media'            => $request->media,
        ]);

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $posko->delete();

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil dihapus.');
    }
}

