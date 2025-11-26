<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
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
            'jenis_bencana'   => 'required|string|max:100',
            'tanggal'         => 'required|date',
            'lokasi_text'     => 'required|string',
            'dampak'          => 'required|string',
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
