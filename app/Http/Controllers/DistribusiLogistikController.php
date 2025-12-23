<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DistribusiLogistikController extends Controller
{
    public function index(Request $request)
    {
        $query = DistribusiLogistik::with(['logistik', 'posko']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('penerima', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%')
                  ->orWhereHas('logistik', function($q) use ($search) {
                      $q->where('nama_barang', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('posko', function($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by tanggal
        if ($request->has('tanggal_dari') && $request->tanggal_dari != '') {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->has('tanggal_sampai') && $request->tanggal_sampai != '') {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        $distribusi = $query->orderBy('tanggal', 'desc')->paginate(30);

        return view('pages.distribusi.index', compact('distribusi'));
    }

    public function create()
    {
        $logistik = LogistikBencana::all();
        $posko = PoskoBencana::all();

        return view('pages.distribusi.create', compact('logistik', 'posko'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'logistik_id' => 'required|exists:logistik_bencana,logistik_id',
            'posko_id' => 'required|exists:posko_bencana,posko_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'penerima' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:200',
            'keterangan' => 'nullable|string',
            'bukti_distribusi' => 'nullable|array|max:5',
            'bukti_distribusi.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Kurangi stok logistik
            $logistik = LogistikBencana::find($validated['logistik_id']);
            if ($logistik->stok < $validated['jumlah']) {
                return back()
                    ->withInput()
                    ->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $logistik->stok]);
            }

            // Buat distribusi
            $distribusi = DistribusiLogistik::create($validated);

            // Kurangi stok
            $logistik->decrement('stok', $validated['jumlah']);

            // Upload multiple files jika ada
            if ($request->hasFile('bukti_distribusi')) {
                foreach ($request->file('bukti_distribusi') as $index => $file) {
                    if ($file->isValid()) {
                        // Generate nama file
                        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $fileName = 'distribusi_' . $distribusi->distribusi_id . '_' . time() . '_' . ($index + 1) . '.' . $extension;

                        // Simpan file
                        $path = $file->storeAs('uploads/distribusi_logistik', $fileName, 'public');

                        if ($path) {
                            // Insert ke tabel media menggunakan DB::table
                            DB::table('media')->insert([
                                'ref_table' => 'distribusi_logistik',
                                'ref_id' => $distribusi->distribusi_id,
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

            DB::commit();

            return redirect()->route('distribusi.index')
                ->with('success', 'Distribusi logistik berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $distribusi = DistribusiLogistik::with(['logistik', 'posko'])->findOrFail($id);

        return view('distribusi.show', compact('distribusi'));
    }

    public function edit($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);
        $logistik = LogistikBencana::all();
        $posko = PoskoBencana::all();

        return view('pages.distribusi.edit', compact('distribusi', 'logistik', 'posko'));
    }

    public function update(Request $request, $id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        $validated = $request->validate([
            'logistik_id' => 'required|exists:logistik_bencana,logistik_id',
            'posko_id' => 'required|exists:posko_bencana,posko_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'penerima' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:200',
            'keterangan' => 'nullable|string',
            'bukti_distribusi' => 'nullable|array|max:5',
            'bukti_distribusi.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_media' => 'nullable|array',
            'delete_media.*' => 'integer',
        ]);

        try {
            DB::beginTransaction();

            $stokBerubah = false;
            $logistikLama = null;
            $logistikBaru = null;

            // Cek jika logistik_id berubah
            if ($distribusi->logistik_id != $validated['logistik_id']) {
                $stokBerubah = true;
                $logistikLama = LogistikBencana::find($distribusi->logistik_id);
                $logistikBaru = LogistikBencana::find($validated['logistik_id']);

                // Kembalikan stok lama
                $logistikLama->increment('stok', $distribusi->jumlah);

                // Kurangi stok baru
                if ($logistikBaru->stok < $validated['jumlah']) {
                    return back()
                        ->withInput()
                        ->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok tersedia: ' . $logistikBaru->stok]);
                }
                $logistikBaru->decrement('stok', $validated['jumlah']);
            }
            // Cek jika jumlah berubah
            elseif ($distribusi->jumlah != $validated['jumlah']) {
                $stokBerubah = true;
                $logistik = LogistikBencana::find($distribusi->logistik_id);

                // Hitung selisih
                $selisih = $validated['jumlah'] - $distribusi->jumlah;

                // Cek apakah stok cukup untuk penambahan
                if ($selisih > 0 && $logistik->stok < $selisih) {
                    return back()
                        ->withInput()
                        ->withErrors(['jumlah' => 'Stok tidak mencukupi untuk penambahan. Stok tersedia: ' . $logistik->stok]);
                }

                // Sesuaikan stok
                if ($selisih > 0) {
                    $logistik->decrement('stok', $selisih);
                } else {
                    $logistik->increment('stok', abs($selisih));
                }
            }

            // Update data distribusi
            $distribusi->update($validated);

            // Handle delete media (jika ada)
            if ($request->has('delete_media')) {
                foreach ($request->input('delete_media') as $mediaId) {
                    // Cari data media yang akan dihapus
                    $media = DB::table('media')
                        ->where('media_id', $mediaId)
                        ->where('ref_table', 'distribusi_logistik')
                        ->where('ref_id', $distribusi->distribusi_id)
                        ->first();

                    if ($media) {
                        // Hapus file fisik jika ada (bukan placeholder)
                        $placeholderNames = ['placeholder.jpg', 'placeholder.png', 'no-image.jpg', 'no-image.png', 'default.jpg'];
                        if (!in_array($media->file_name, $placeholderNames) &&
                            !str_contains($media->file_name, 'placeholder') &&
                            !str_contains($media->file_name, 'no-image') &&
                            !str_contains($media->file_name, 'default')) {

                            // Cek apakah file benar-benar ada
                            $path = 'uploads/distribusi_logistik/' . $media->file_name;
                            if (Storage::disk('public')->exists($path)) {
                                Storage::disk('public')->delete($path);
                            }
                        }

                        // Hapus data dari tabel media
                        DB::table('media')
                            ->where('media_id', $mediaId)
                            ->where('ref_table', 'distribusi_logistik')
                            ->where('ref_id', $distribusi->distribusi_id)
                            ->delete();
                    }
                }
            }

            // Handle upload new photos
            if ($request->hasFile('bukti_distribusi')) {
                // Get current max sort_order
                $currentMax = DB::table('media')
                    ->where('ref_table', 'distribusi_logistik')
                    ->where('ref_id', $distribusi->distribusi_id)
                    ->max('sort_order') ?? 0;

                foreach ($request->file('bukti_distribusi') as $index => $file) {
                    if ($file->isValid()) {
                        // Generate nama file
                        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $fileName = 'distribusi_' . $distribusi->distribusi_id . '_' . time() . '_' . ($index + 1) . '.' . $extension;

                        // Simpan file
                        $path = $file->storeAs('uploads/distribusi_logistik', $fileName, 'public');

                        if ($path) {
                            // Insert ke tabel media menggunakan DB::table
                            DB::table('media')->insert([
                                'ref_table' => 'distribusi_logistik',
                                'ref_id' => $distribusi->distribusi_id,
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

            DB::commit();

            return redirect()->route('distribusi.show', $distribusi->distribusi_id)
                ->with('success', 'Distribusi logistik berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        try {
            DB::beginTransaction();

            // Kembalikan stok
            $logistik = LogistikBencana::find($distribusi->logistik_id);
            if ($logistik) {
                $logistik->increment('stok', $distribusi->jumlah);
            }

            // Ambil semua data media untuk distribusi ini
            $files = DB::table('media')
                ->where('ref_table', 'distribusi_logistik')
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
                    $path = 'uploads/distribusi_logistik/' . $file->file_name;
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }

            // Hapus data media dari database
            DB::table('media')
                ->where('ref_table', 'distribusi_logistik')
                ->where('ref_id', $id)
                ->delete();

            // Hapus distribusi
            $distribusi->delete();

            DB::commit();

            return redirect()->route('distribusi.index')
                ->with('success', 'Distribusi logistik berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
