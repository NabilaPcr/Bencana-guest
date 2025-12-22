<?php

namespace App\Http\Controllers;

use App\Models\LogistikBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogistikBencanaController extends Controller
{
    /**
     * Menampilkan daftar logistik
     */
    public function index(Request $request)
    {
        $query = LogistikBencana::with('kejadian');

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('sumber', 'like', "%{$search}%")
                  ->orWhereHas('kejadian', function($q2) use ($search) {
                      $q2->where('jenis_bencana', 'like', "%{$search}%")
                         ->orWhere('lokasi_text', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by kejadian
        if ($request->has('kejadian_id') && $request->kejadian_id != '') {
            $query->where('kejadian_id', $request->kejadian_id);
        }

        $logistik = $query->orderBy('nama_barang')->paginate(12);
        $kejadians = KejadianBencana::all();

        return view('pages.logistik.index', compact('logistik', 'kejadians'));
    }

    /**
     * Menampilkan form untuk membuat logistik baru
     */
    public function create()
    {
        $kejadians = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->get();

        return view('pages.logistik.create', compact('kejadians'));
    }

    /**
     * Menyimpan logistik baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama_barang' => 'required|string|max:200',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'sumber' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        LogistikBencana::create($request->all());

        return redirect()->route('logistik.index')
            ->with('success', 'Logistik berhasil ditambahkan');
    }

    /**
     * Menampilkan detail logistik
     */
    public function show($id)
    {
        $logistik = LogistikBencana::with('kejadian')->findOrFail($id);

        return view('pages.logistik.show', compact('logistik'));
    }

    /**
     * Menampilkan form untuk mengedit logistik
     */
    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadians = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->get();

        return view('pages.logistik.edit', compact('logistik', 'kejadians'));
    }

    /**
     * Update logistik
     */
    public function update(Request $request, $id)
    {
        $logistik = LogistikBencana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama_barang' => 'required|string|max:200',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'sumber' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $logistik->update($request->all());

        return redirect()->route('logistik.index')
            ->with('success', 'Logistik berhasil diperbarui');
    }

    /**
     * Hapus logistik
     */
    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $logistik->delete();

        return redirect()->route('logistik.index')
            ->with('success', 'Logistik berhasil dihapus');
    }

    /**
     * Update stok logistik
     */
    public function updateStok(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stok' => 'required|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $logistik = LogistikBencana::findOrFail($id);
        $logistik->update([
            'stok' => $request->stok
        ]);

        return redirect()->route('logistik.show', $id)
            ->with('success', 'Stok berhasil diperbarui');
    }

    /**
     * Menampilkan logistik berdasarkan kejadian tertentu (API/JSON)
     * Untuk API jika diperlukan
     */
    // public function byKejadian($kejadian_id)
    // {
    //     $kejadian = KejadianBencana::find($kejadian_id);

    //     if (!$kejadian) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Kejadian tidak ditemukan'
    //         ], 404);
    //     }

    //     $logistik = LogistikBencana::where('kejadian_id', $kejadian_id)
    //         ->orderBy('nama_barang')
    //         ->get();

    //     return response()->json([
    //         'success' => true,
    //         'kejadian' => $kejadian,
    //         'data' => $logistik
    //     ]);
    // }
}
