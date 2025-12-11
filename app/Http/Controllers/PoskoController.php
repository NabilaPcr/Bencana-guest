<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Filter by jenis bencana
        if ($request->has('jenis_bencana') && $request->jenis_bencana != '') {
            $query->whereHas('kejadian', function($q) use ($request) {
                $q->where('jenis_bencana', $request->jenis_bencana);
            });
        }

        $poskoBencana = $query->paginate(10);

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
        $validated = $request->validate([
            'posko_id' => 'required|unique:posko_bencana,posko_id',
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'penanggung_jawab' => 'required|string|max:255',
            'fotos' => 'required|array|max:5',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $posko = PoskoBencana::create($validated);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    $path = $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    if ($path) {
                        Media::create([
                            'ref_table' => 'posko_bencana',
                            'ref_id' => $posko->posko_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $index + 1,
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
        $files = Media::where('ref_table', 'posko_bencana')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.posko.show', compact('posko', 'files'));
    }

    public function edit($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $kejadianList = KejadianBencana::all();
        $files = Media::where('ref_table', 'posko_bencana')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.posko.edit', compact('posko', 'kejadianList', 'files'));
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

        $posko->update($validated);

        if ($request->has('delete_media')) {
            foreach ($request->input('delete_media') as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->ref_table == 'posko_bencana' && $media->ref_id == $posko->posko_id) {
                    Storage::disk('public')->delete('uploads/posko_bencana/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('fotos')) {
            $currentMax = Media::where('ref_table', 'posko_bencana')
                ->where('ref_id', $posko->posko_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    $path = $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    if ($path) {
                        Media::create([
                            'ref_table' => 'posko_bencana',
                            'ref_id' => $posko->posko_id,
                            'file_name' => $fileName,
                            'caption' => null,
                            'mime_type' => $file->getMimeType(),
                            'sort_order' => $currentMax + $index + 1,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $posko = PoskoBencana::findOrFail($id);

        $files = Media::where('ref_table', 'posko_bencana')
                     ->where('ref_id', $id)
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete('uploads/posko_bencana/' . $file->file_name);
            $file->delete();
        }

        $posko->delete();

        return redirect()->route('posko.index')
            ->with('success', 'Posko bencana berhasil dihapus.');
    }
}
