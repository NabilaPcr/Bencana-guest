<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana; // Diubah dari Kejadian ke KejadianBencana
use Illuminate\Http\Request;

class PoskoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poskoBencana = PoskoBencana::with('kejadianBencana')->get(); // Diubah dari 'kejadian' ke 'kejadianBencana'
        return view('pages.posko.index', compact('poskoBencana'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kejadianList = KejadianBencana::all(); // Diubah dari Kejadian ke KejadianBencana
        return view('pages.posko.create', compact('kejadianList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'posko_id'         => 'required|unique:posko_bencana',
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id', // Diubah nama tabel
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak'           => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            'media'            => 'nullable|string',
        ]);

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('posko_fotos', 'public');
        }

        PoskoBencana::create([
            'posko_id'         => $request->posko_id,
            'kejadian_id'      => $request->kejadian_id,
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            'foto'             => $fotoPath,
            'kontak'           => $request->kontak,
            'penanggung_jawab' => $request->penanggung_jawab,
            'media'            => $request->media,
        ]);

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Posko bencana berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $posko = PoskoBencana::with('kejadianBencana')->findOrFail($id); // Diubah dari 'kejadian' ke 'kejadianBencana'
        return view('pages.posko.show', compact('posko'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posko        = PoskoBencana::findOrFail($id);
        $kejadianList = KejadianBencana::all(); // Diubah dari Kejadian ke KejadianBencana
        return view('pages.posko.edit', compact('posko', 'kejadianList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id', // Diubah nama tabel
            'nama'             => 'required|string|max:255',
            'alamat'           => 'required|string',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak'           => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            'media'            => 'nullable|string',
        ]);

        $posko = PoskoBencana::findOrFail($id);

        // Handle upload foto jika ada
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
            'media'            => $request->media,
        ]);

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Posko bencana berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $posko->delete();

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil dihapus.');
    }
}
