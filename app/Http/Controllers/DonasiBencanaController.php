<?php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
    public function index()
    {
        $donasi = DonasiBencana::with('kejadian')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.donasi.index', compact('donasi'));
    }

    public function create()
    {
        $kejadianList = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi.create', compact('kejadianList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis' => 'required|in:uang,barang',
            'nilai' => 'required|numeric|min:0',
            'bukti_donasi' => 'required|array|max:5',
            'bukti_donasi.*' => 'mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        $donasi = DonasiBencana::create($validated);

        if ($request->hasFile('bukti_donasi')) {
            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    $path = $file->storeAs('uploads/donasi_bencana', $fileName, 'public');

                    if ($path) {
                        Media::create([
                            'ref_table' => 'donasi_bencana',
                            'ref_id' => $donasi->donasi_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $index + 1,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $donasiBencana = DonasiBencana::findOrFail($id);
        $files = Media::where('ref_table', 'donasi_bencana')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.donasi.show', compact('donasiBencana', 'files'));
    }

    public function edit($id)
    {
        $donasiBencana = DonasiBencana::findOrFail($id);
        $kejadianList = KejadianBencana::where('status_kejadian', 'aktif')
            ->orWhere('status_kejadian', 'dalam penanganan')
            ->orderBy('tanggal', 'desc')
            ->get();

        $files = Media::where('ref_table', 'donasi_bencana')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.donasi.edit', compact('donasiBencana', 'kejadianList', 'files'));
    }

    public function update(Request $request, $id)
    {
        $donasiBencana = DonasiBencana::findOrFail($id);

        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|string|max:100',
            'jenis' => 'required|in:uang,barang',
            'nilai' => 'required|numeric|min:0',
            'bukti_donasi' => 'nullable|array|max:5',
            'bukti_donasi.*' => 'mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'delete_media' => 'nullable|array',
            'delete_media.*' => 'integer',
        ]);

        $donasiBencana->update($validated);

        if ($request->has('delete_media')) {
            foreach ($request->input('delete_media') as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->ref_table == 'donasi_bencana' && $media->ref_id == $donasiBencana->donasi_id) {
                    Storage::disk('public')->delete('uploads/donasi_bencana/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('bukti_donasi')) {
            $currentMax = Media::where('ref_table', 'donasi_bencana')
                ->where('ref_id', $donasiBencana->donasi_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    $path = $file->storeAs('uploads/donasi_bencana', $fileName, 'public');

                    if ($path) {
                        Media::create([
                            'ref_table' => 'donasi_bencana',
                            'ref_id' => $donasiBencana->donasi_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $currentMax + $index + 1,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $donasiBencana = DonasiBencana::findOrFail($id);

        $files = Media::where('ref_table', 'donasi_bencana')
                     ->where('ref_id', $id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete('uploads/donasi_bencana/' . $file->file_name);
            $file->delete();
        }

        $donasiBencana->delete();

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil dihapus!');
    }
}
