<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KejadianController extends Controller
{
    public function index(Request $request)
    {
        $query = KejadianBencana::query();

        // SEARCH
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jenis_bencana', 'like', "%{$search}%")
                    ->orWhere('lokasi_text', 'like', "%{$search}%")
                    ->orWhere('dampak', 'like', "%{$search}%");
            });
        }

        // FILTER
        if ($request->has('jenis_bencana') && $request->jenis_bencana != '') {
            $query->where('jenis_bencana', $request->jenis_bencana);
        }
        if ($request->has('status_kejadian') && $request->status_kejadian != '') {
            $query->where('status_kejadian', $request->status_kejadian);
        }

        // SORTING
        $sort  = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        // PAGINATION
        $kejadian = $query->paginate(30);
        $kejadian->appends($request->all());

        return view('pages.kejadian.index', compact('kejadian'));
    }

    public function show($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $files = Media::where('ref_table', 'kejadian_bencana')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.kejadian.show', compact('kejadian', 'files'));
    }

    public function create()
    {
        return view('pages.kejadian.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string',
            'rt'              => 'nullable|string|max:10',
            'rw'              => 'nullable|string|max:10',
            'dampak'          => 'required|string',
            'status_kejadian' => 'required|in:aktif,dalam penanganan,selesai',
            'keterangan'      => 'nullable|string',
            // ✅ VALIDASI: MAKSIMAL 5 FILE
            'fotos'           => 'required|array|min:1|max:5',
            'fotos.*'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data kejadian
        $kejadian = KejadianBencana::create($validated);

        // Upload multiple photos
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    // Generate unique filename
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension    = $file->getClientOriginalExtension();
                    $fileName     = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    // Store file
                    $path = $file->storeAs('uploads/kejadian_bencana', $fileName, 'public');

                    if ($path) {
                        // Save to media table
                        Media::create([
                            'ref_table'  => 'kejadian_bencana',
                            'ref_id'     => $kejadian->kejadian_id,
                            'file_name'  => $fileName,
                            'caption'    => null, // Tidak ada caption tanpa JS
                            'mime_type'  => $file->getMimeType(),
                            'sort_order' => $index + 1,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        $files = Media::where('ref_table', 'kejadian_bencana')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.kejadian.edit', compact('kejadian', 'files'));
    }

    public function update(Request $request, $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $validated = $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string',
            'rt'              => 'nullable|string|max:10',
            'rw'              => 'nullable|string|max:10',
            'dampak'          => 'required|string',
            'status_kejadian' => 'required|in:aktif,dalam penanganan,selesai',
            'keterangan'      => 'nullable|string',
            // ✅ VALIDASI: MAKSIMAL 5 FILE (opsional di update)
            'fotos'           => 'nullable|array|max:5',
            'fotos.*'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_media'    => 'nullable|array',
            'delete_media.*'  => 'integer',
        ]);

        // Update data kejadian
        $kejadian->update($validated);

        // Delete selected media
        if ($request->has('delete_media')) {
            foreach ($request->input('delete_media') as $mediaId) {
                $media = Media::find($mediaId);
                if ($media && $media->ref_table == 'kejadian_bencana' && $media->ref_id == $kejadian->kejadian_id) {
                    // Delete from storage
                    Storage::disk('public')->delete('uploads/kejadian_bencana/' . $media->file_name);
                    // Delete from database
                    $media->delete();
                }
            }
        }

        // Upload new photos
        if ($request->hasFile('fotos')) {
            // Get current max sort_order
            $currentMax = Media::where('ref_table', 'kejadian_bencana')
                ->where('ref_id', $kejadian->kejadian_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('fotos') as $index => $file) {
                if ($file->isValid()) {
                    // Generate unique filename
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension    = $file->getClientOriginalExtension();
                    $fileName     = $originalName . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

                    // Store file
                    $path = $file->storeAs('uploads/kejadian_bencana', $fileName, 'public');

                    if ($path) {
                        // Save to media table
                        Media::create([
                            'ref_table'  => 'kejadian_bencana',
                            'ref_id'     => $kejadian->kejadian_id,
                            'file_name'  => $fileName,
                            'caption'    => null,
                            'mime_type'  => $file->getMimeType(),
                            'sort_order' => $currentMax + $index + 1,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Delete all related media
        $mediaList = $kejadian->media;
        foreach ($mediaList as $media) {
            Storage::disk('public')->delete('uploads/kejadian_bencana/' . $media->file_name);
            $media->delete();
        }

        // Delete kejadian
        $kejadian->delete();

        return redirect()->route('kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus!');
    }

    // Method untuk menghapus file - SAMA SEPERTI PELANGGAN
    public function destroyFile($id)
    {
        $file = Media::findOrFail($id);

        // Delete file dari storage
        Storage::disk('public')->delete('kejadian_bencana/' . $file->file_name);

        // Delete record dari database
        $file->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus!');
    }
}
