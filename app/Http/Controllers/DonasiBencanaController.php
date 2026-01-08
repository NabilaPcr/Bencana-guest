<?php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
    private $placeholderPath = 'public/storages/uploads/donasi_bencana/placeholder.jpg';

    public function index(Request $request)
    {
        // Query untuk kejadian bencana yang memiliki donasi
        $query = KejadianBencana::withCount(['donasi as total_donasi_uang' => function($q) {
                $q->where('jenis', 'uang')->select(\DB::raw('COALESCE(SUM(nilai), 0)'));
            }])
            ->withCount(['donasi as total_donasi_barang' => function($q) {
                $q->where('jenis', 'barang')->select(\DB::raw('COALESCE(SUM(nilai), 0)'));
            }])
            ->has('donasi');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('jenis_bencana', 'like', '%' . $search . '%')
                  ->orWhere('lokasi_text', 'like', '%' . $search . '%')
                  ->orWhereHas('donasi', function($q) use ($search) {
                      $q->where('donatur_nama', 'like', '%' . $search . '%');
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

        return view('pages.donasi.index', compact('kejadianList', 'jenisBencanaList'));
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
            'bukti_donasi' => 'nullable|array|max:5',
            'bukti_donasi.*' => 'mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        // Simpan data donasi
        $donasi = DonasiBencana::create($validated);

        if ($request->hasFile('bukti_donasi')) {
            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    $this->uploadImage($file, $donasi->donasi_id, $index + 1);
                }
            }
        } else {
            $this->savePlaceholderImage($donasi->donasi_id);
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

        if ($files->isEmpty()) {
            $files = collect([$this->getPlaceholderData()]);
        } else {
            $files = $files->map(function ($file) {
                if ($file->file_name === 'placeholder.jpg') {
                    return $this->getPlaceholderData();
                }

                $file->url = $this->getFileUrl($file->file_name);
                $file->is_placeholder = false;
                return $file;
            });
        }

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

        if ($files->isNotEmpty()) {
            $files = $files->map(function ($file) {
                $file->url = $this->getFileUrl($file->file_name);
                $file->is_placeholder = ($file->file_name === 'placeholder.jpg');
                return $file;
            });
        }

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
                    if ($media->file_name !== 'placeholder.jpg') {
                        Storage::disk('public')->delete('uploads/donasi_bencana/' . $media->file_name);
                    }
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('bukti_donasi')) {
            $currentMax = Media::where('ref_table', 'donasi_bencana')
                ->where('ref_id', $donasiBencana->donasi_id)
                ->max('sort_order') ?? 0;

            Media::where('ref_table', 'donasi_bencana')
                ->where('ref_id', $donasiBencana->donasi_id)
                ->where('file_name', 'placeholder.jpg')
                ->delete();

            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    $this->uploadImage($file, $donasiBencana->donasi_id, $currentMax + $index + 1);
                }
            }
        }

        $remainingFiles = Media::where('ref_table', 'donasi_bencana')
            ->where('ref_id', $donasiBencana->donasi_id)
            ->count();

        if ($remainingFiles === 0) {
            $this->savePlaceholderImage($donasiBencana->donasi_id);
        }

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $donasiBencana = DonasiBencana::findOrFail($id);

        $files = Media::where('ref_table', 'donasi_bencana')
                     ->where('ref_id', $id)
                     ->where('file_name', '!=', 'placeholder.jpg')
                     ->get();

        foreach ($files as $file) {
            Storage::disk('public')->delete('uploads/donasi_bencana/' . $file->file_name);
            $file->delete();
        }

        Media::where('ref_table', 'donasi_bencana')
            ->where('ref_id', $id)
            ->where('file_name', 'placeholder.jpg')
            ->delete();

        $donasiBencana->delete();

        return redirect()->route('donasi.index')
            ->with('success', 'Data donasi berhasil dihapus!');
    }

    /**
     */
    private function uploadImage($file, $donasiId, $sortOrder)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

        $path = $file->storeAs('uploads/donasi_bencana', $fileName, 'public');

        if ($path) {
            Media::create([
                'ref_table' => 'donasi_bencana',
                'ref_id' => $donasiId,
                'file_name' => $fileName,
                'caption' => null,
                'mime_type' => $file->getMimeType(),
                'sort_order' => $sortOrder,
            ]);
        }
    }

    /**
     * Simpan placeholder image ke database
     */
    private function savePlaceholderImage($donasiId)
    {
        $placeholderSource = public_path($this->placeholderPath);
        $placeholderDest = 'uploads/donasi_bencana/placeholder.jpg';

        if (file_exists($placeholderSource) && !Storage::disk('public')->exists($placeholderDest)) {
            Storage::disk('public')->put($placeholderDest, file_get_contents($placeholderSource));
        }

        Media::create([
            'ref_table' => 'donasi_bencana',
            'ref_id' => $donasiId,
            'file_name' => 'placeholder.jpg',
            'caption' => 'Tidak ada gambar yang diupload',
            'mime_type' => 'image/jpeg',
            'sort_order' => 1,
        ]);
    }

    /**
     * Get data placeholder untuk view
     */
    private function getPlaceholderData()
    {
        return (object)[
            'media_id' => null,
            'file_name' => 'placeholder.jpg',
            'caption' => 'Tidak ada gambar yang diupload',
            'mime_type' => 'image/jpeg',
            'sort_order' => 1,
            'url' => $this->getPlaceholderUrl(),
            'is_placeholder' => true,
        ];
    }

    /**
     * Get URL untuk file
     */
    private function getFileUrl($fileName)
    {
        if ($fileName === 'placeholder.jpg') {
            return $this->getPlaceholderUrl();
        }

        return Storage::url('uploads/donasi_bencana/' . $fileName);
    }

    /**
     * Get URL placeholder
     */
    private function getPlaceholderUrl()
    {
        if (Storage::disk('public')->exists('uploads/donasi_bencana/placeholder.jpg')) {
            return Storage::url('uploads/donasi_bencana/placeholder.jpg');
        }

        return asset($this->placeholderPath);
    }

    /**
     * Download file
     */
    public function downloadFile($id, $mediaId)
    {
        $media = Media::findOrFail($mediaId);

        if ($media->ref_table !== 'donasi_bencana' || $media->ref_id != $id) {
            abort(404);
        }

        if ($media->file_name === 'placeholder.jpg') {
            return response()->download(public_path($this->placeholderPath), 'placeholder-donasi.jpg');
        }

        $path = Storage::disk('public')->path('uploads/donasi_bencana/' . $media->file_name);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $media->file_name);
    }

    /**
     * View file (preview)
     */
    public function viewFile($id, $mediaId)
    {
        $media = Media::findOrFail($mediaId);

        if ($media->ref_table !== 'donasi_bencana' || $media->ref_id != $id) {
            abort(404);
        }

        if ($media->file_name === 'placeholder.jpg') {
            return response()->file(public_path($this->placeholderPath));
        }

        $path = Storage::disk('public')->path('uploads/donasi_bencana/' . $media->file_name);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
   public function byKejadian(KejadianBencana $kejadian)
{
    $kejadian->load('donasi');
    return view('pages.donasi.by-kejadian', compact('kejadian'));
}

}
