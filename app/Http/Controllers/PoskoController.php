<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PoskoController extends Controller
{
    // Update di PoskoController.php
public function index(Request $request)
{
    // Query untuk kejadian bencana yang memiliki posko
    $query = KejadianBencana::withCount('posko')->has('posko');

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('jenis_bencana', 'like', '%' . $search . '%')
              ->orWhere('lokasi_text', 'like', '%' . $search . '%')
              ->orWhereHas('posko', function($q) use ($search) {
                  $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('penanggung_jawab', 'like', '%' . $search . '%');
              });
        });
    }

    // Filter by jenis bencana
    if ($request->has('jenis_bencana') && $request->jenis_bencana != '') {
        $query->where('jenis_bencana', $request->jenis_bencana);
    }

    $kejadianList = $query->paginate(15);

    $jenisBencanaList = KejadianBencana::distinct()
        ->pluck('jenis_bencana')
        ->sort();

    return view('pages.posko.index', compact('kejadianList', 'jenisBencanaList'));
}

    public function create()
    {
        $kejadianList = KejadianBencana::all();
        return view('pages.posko.create', compact('kejadianList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            'fotos' => 'required|array|max:5',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $posko = PoskoBencana::create([
            'kejadian_id' => $validated['kejadian_id'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'kontak' => $validated['kontak'],
            'penanggung_jawab' => $validated['penanggung_jawab'],
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'posko_' . $posko->posko_id . '_' . time() . '_' . ($index + 1) . '.' . $extension;

                    // Simpan file
                    $path = $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    if ($path) {
                        // Insert ke tabel media menggunakan DB::table (tidak pakai model)
                        DB::table('media')->insert([
                            'ref_table' => 'posko_bencana',
                            'ref_id' => $posko->posko_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $index + 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil ditambahkan!');
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
        $posko = PoskoBencana::findOrFail($id);

        $validated = $request->validate([
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            'fotos' => 'nullable|array|max:5',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_media' => 'nullable|array',
            'delete_media.*' => 'integer',
        ]);

        // Update data posko
        $posko->update($validated);

        // Handle delete media (jika ada)
        if ($request->has('delete_media')) {
            foreach ($request->input('delete_media') as $mediaId) {
                // Cari data media yang akan dihapus
                $media = DB::table('media')
                    ->where('media_id', $mediaId)
                    ->where('ref_table', 'posko_bencana')
                    ->where('ref_id', $posko->posko_id)
                    ->first();

                if ($media) {
                    // Hapus file fisik jika ada (bukan placeholder)
                    $placeholderNames = ['placeholder.jpg', 'placeholder.png', 'no-image.jpg', 'no-image.png', 'default.jpg'];
                    if (!in_array($media->file_name, $placeholderNames) &&
                        !str_contains($media->file_name, 'placeholder') &&
                        !str_contains($media->file_name, 'no-image') &&
                        !str_contains($media->file_name, 'default')) {

                        // Cek apakah file benar-benar ada
                        $path = 'uploads/posko_bencana/' . $media->file_name;
                        if (Storage::disk('public')->exists($path)) {
                            Storage::disk('public')->delete($path);
                        }
                    }

                    // Hapus data dari tabel media
                    DB::table('media')
                        ->where('media_id', $mediaId)
                        ->where('ref_table', 'posko_bencana')
                        ->where('ref_id', $posko->posko_id)
                        ->delete();
                }
            }
        }

        // Handle upload new photos
        if ($request->hasFile('fotos')) {
            // Get current max sort_order
            $currentMax = DB::table('media')
                ->where('ref_table', 'posko_bencana')
                ->where('ref_id', $posko->posko_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    // Generate nama file
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = 'posko_' . $posko->posko_id . '_' . time() . '_' . ($index + 1) . '.' . $extension;

                    // Simpan file
                    $path = $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    if ($path) {
                        // Insert ke tabel media menggunakan DB::table
                        DB::table('media')->insert([
                            'ref_table' => 'posko_bencana',
                            'ref_id' => $posko->posko_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $currentMax + $index + 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }

        return redirect()->route('posko.show', $posko->posko_id)
            ->with('success', 'Posko bencana berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $posko = PoskoBencana::findOrFail($id);

        // Ambil semua data media untuk posko ini
        $files = DB::table('media')
            ->where('ref_table', 'posko_bencana')
            ->where('ref_id', $id)
            ->get();

        // Hapus file fisik (kecuali placeholder)
        foreach ($files as $file) {
            $placeholderNames = ['placeholder.jpg', 'placeholder.png', 'no-image.jpg', 'no-image.png', 'default.jpg'];
            if (!in_array($file->file_name, $placeholderNames) &&
                !str_contains($file->file_name, 'placeholder') &&
                !str_contains($file->file_name, 'no-image') &&
                !str_contains($file->file_name, 'default')) {

                // Cek apakah file benar-benar ada
                $path = 'uploads/posko_bencana/' . $file->file_name;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        // Hapus data media dari database
        DB::table('media')
            ->where('ref_table', 'posko_bencana')
            ->where('ref_id', $id)
            ->delete();

        // Hapus posko
        $posko->delete();

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil dihapus.');
    }
}
