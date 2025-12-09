<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KejadianController extends Controller
{

    public function index(Request $request)
    {
        $query = KejadianBencana::query();

        // SEARCH - Mencari berdasarkan jenis bencana, lokasi, atau dampak
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jenis_bencana', 'like', "%{$search}%")
                    ->orWhere('lokasi_text', 'like', "%{$search}%")
                    ->orWhere('dampak', 'like', "%{$search}%");
            });
        }

        // FILTER - Filter berdasarkan jenis bencana
        if ($request->has('jenis_bencana') && $request->jenis_bencana != '') {
            $query->where('jenis_bencana', $request->jenis_bencana);
        }

        // FILTER - Filter berdasarkan status kejadian
        if ($request->has('status_kejadian') && $request->status_kejadian != '') {
            $query->where('status_kejadian', $request->status_kejadian);
        }

        // SORTING - Default urutkan terbaru
        $sort  = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        // PAGINATION - 10 data per halaman
        $kejadian = $query->paginate(10);

        // Untuk menjaga filter saat pindah halaman
        $kejadian->appends($request->all());

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
        'jenis_bencana'   => 'required|string|max:100',
        'tanggal'         => 'required|date',
        'lokasi_text'     => 'required|string',
        'dampak'          => 'required|string',
        'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
        'foto_kejadian.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi file
    ]);

    // Simpan data kejadian bencana
    $kejadian = KejadianBencana::create($request->all());

    // Upload foto jika ada
    if ($request->hasFile('foto_kejadian')) {
        $sortOrder = 1;
        foreach ($request->file('foto_kejadian') as $file) {
            // Generate nama file unik
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage
            $file->storeAs('kejadian_bencana', $fileName, 'public');

            // Simpan ke tabel media
            Media::create([
                'ref_table' => 'kejadian_bencana',
                'ref_id' => $kejadian->kejadian_id,
                'file_name' => $fileName,
                'caption' => 'Foto dokumentasi kejadian',
                'mime_type' => $file->getMimeType(),
                'sort_order' => $sortOrder
            ]);

            $sortOrder++;
        }
    }

    return redirect()->route('kejadian.index')
        ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
}


    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('pages.kejadian.edit', compact('kejadian'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'jenis_bencana'   => 'required|string|max:100',
        'tanggal'         => 'required|date',
        'lokasi_text'     => 'required|string',
        'dampak'          => 'required|string',
        'status_kejadian' => 'required|in:aktif,selesai,dalam penanganan',
        'foto_kejadian.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $kejadian = KejadianBencana::findOrFail($id);
    $kejadian->update($request->all());

    // Upload foto baru jika ada
    if ($request->hasFile('foto_kejadian')) {
        // Ambil sort_order terakhir
        $lastSortOrder = Media::where('ref_table', 'kejadian_bencana')
                             ->where('ref_id', $id)
                             ->max('sort_order') ?? 0;

        $sortOrder = $lastSortOrder + 1;

        foreach ($request->file('foto_kejadian') as $file) {
            // Generate nama file unik
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage
            $file->storeAs('kejadian_bencana', $fileName, 'public');

            // Simpan ke tabel media
            Media::create([
                'ref_table' => 'kejadian_bencana',
                'ref_id' => $kejadian->kejadian_id,
                'file_name' => $fileName,
                'caption' => 'Foto dokumentasi kejadian',
                'mime_type' => $file->getMimeType(),
                'sort_order' => $sortOrder
            ]);

            $sortOrder++;
        }
    }

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
