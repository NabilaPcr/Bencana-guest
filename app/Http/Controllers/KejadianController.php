<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KejadianBencana;

class KejadianController extends Controller
{
    public function index()
    {
        $kejadian = KejadianBencana::orderBy('tanggal', 'desc')->get();
        return view('pages.kejadian.index', compact('kejadian'));
    }

    public function show($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('pages.kejadian.show', compact('kejadian'));
    }
    public function create()
{
    return view('pages.kejadian.create');
}

public function store(Request $request)
{
    $request->validate([
        'jenis_bencana' => 'required|string|max:100',
        'tanggal' => 'required|date',
        'lokasi_text' => 'required|string',
        'dampak' => 'required|string',
        'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
    ]);

    KejadianBencana::create($request->all());

    return redirect()->route('kejadian.index')
        ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
}
// Tambahkan method ini di KejadianController
public function edit($id)
{
    $kejadian = KejadianBencana::findOrFail($id);
    return view('pages.kejadian.edit', compact('kejadian'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'jenis_bencana' => 'required|string|max:100',
        'tanggal' => 'required|date',
        'lokasi_text' => 'required|string',
        'dampak' => 'required|string',
        'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
    ]);

    $kejadian = KejadianBencana::findOrFail($id);
    $kejadian->update($request->all());

    return redirect()->route('kejadian.index')
        ->with('success', 'Data kejadian bencana berhasil diperbarui!');
}

public function destroy($id)
{
    $kejadian = KejadianBencana::findOrFail($id);
    $kejadian->delete();

    return redirect()->route('kejadian.index')
        ->with('success', 'Data kejadian bencana berhasil dihapus!');
}
}


