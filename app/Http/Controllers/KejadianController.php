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
        $kejadian = $query->paginate(10);
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
        $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string',
            'dampak'          => 'required|string',
            'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
        ]);

        // Simpan data kejadian
        $kejadian = KejadianBencana::create($request->all());

        // Handle file uploads - SAMA PERSIS SEPERTI PELANGGAN
        if ($request->hasFile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Store file
                    $filePath = $file->storeAs('kejadian_bencana', $filename, 'public');

                    // Save file info to database - ke tabel media
                    Media::create([
                        'ref_table' => 'kejadian_bencana',
                        'ref_id'    => $kejadian->kejadian_id,
                        'file_name' => $filename,
                        'caption'   => 'Foto dokumentasi kejadian',
                        'mime_type' => $file->getClientMimeType(),
                        'sort_order' => 1
                    ]);

                    $uploadedFiles[] = $file->getClientOriginalName();
                }
            }

            // Success message dengan info files yang diupload
            if (! empty($uploadedFiles)) {
                $fileCount = count($uploadedFiles);
                $fileNames = implode(', ', $uploadedFiles);
                return redirect()->route('kejadian.index')
                    ->with('success', "Data berhasil ditambahkan! {$fileCount} file berhasil diupload: {$fileNames}");
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Ambil semua file media yang sudah ada (SAMA SEPERTI PELANGGAN)
        $files = Media::where('ref_table', 'kejadian_bencana')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.kejadian.edit', compact('kejadian', 'files'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string',
            'dampak'          => 'required|string',
            'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
        ]);

        $kejadian = KejadianBencana::findOrFail($id);
        $kejadian->update($request->all());

        // Handle file uploads - SAMA PERSIS SEPERTI PELANGGAN
        if ($request->hasFile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Store file
                    $filePath = $file->storeAs('kejadian_bencana', $filename, 'public');

                    // Get next sort order
                    $lastSortOrder = Media::where('ref_table', 'kejadian_bencana')
                                         ->where('ref_id', $id)
                                         ->max('sort_order') ?? 0;

                    // Save file info to database
                    Media::create([
                        'ref_table' => 'kejadian_bencana',
                        'ref_id'    => $id,
                        'file_name' => $filename,
                        'caption'   => 'Foto dokumentasi kejadian',
                        'mime_type' => $file->getClientMimeType(),
                        'sort_order' => $lastSortOrder + 1
                    ]);

                    $uploadedFiles[] = $file->getClientOriginalName();
                }
            }

            // Success message dengan info files yang diupload
            if (! empty($uploadedFiles)) {
                $fileCount = count($uploadedFiles);
                $fileNames = implode(', ', $uploadedFiles);
                return redirect()->route('kejadian.index')
                    ->with('success', "Perubahan Data Berhasil! {$fileCount} file berhasil diupload: {$fileNames}");
            }
        }

        return redirect()->route('kejadian.index')
            ->with('success', 'Perubahan Data Berhasil!');
    }

    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
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
