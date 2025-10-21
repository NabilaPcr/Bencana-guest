<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KejadianBencana;

class KejadianController extends Controller
{
     public function index()
    {
        $kejadian = KejadianBencana::orderBy('tanggal', 'desc')->get();
        return view('guest.kejadian.index', compact('kejadian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.kejadian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('guest.kejadian.show', compact('kejadian'));
    }

    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('guest.kejadian.edit', compact('kejadian'));
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
