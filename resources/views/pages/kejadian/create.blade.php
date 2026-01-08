@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('kejadian.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Kejadian
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-plus-circle"></i> Tambah Kejadian Bencana</h1>
                <p>Isi form berikut untuk melaporkan kejadian bencana baru</p>
            </div>

            <form action="{{ route('kejadian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="jenis_bencana">Jenis Bencana *</label>
                    <input type="text" id="jenis_bencana" name="jenis_bencana" required
                        placeholder="Contoh: Banjir, Gempa Bumi, Kebakaran">
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Kejadian *</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="lokasi_text">Lokasi Kejadian *</label>
                    <textarea id="lokasi_text" name="lokasi_text" required placeholder="Deskripsikan lokasi kejadian dengan jelas"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" id="rt" name="rt" placeholder="Contoh: 05">
                    </div>

                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" id="rw" name="rw" placeholder="Contoh: 02">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dampak">Dampak yang Terjadi *</label>
                    <textarea id="dampak" name="dampak" required
                        placeholder="Deskripsikan dampak yang terjadi, contoh: 50 rumah terendam, 200 warga mengungsi"></textarea>
                </div>

                <!-- FIELD PEMILIHAN POSKO -->
                <div class="form-group">
                    <label for="posko_id">
                        <i class="fas fa-first-aid"></i> Posko Penanganan
                        <a href="{{ route('posko.create') }}" class="btn-add-small ms-2" target="_blank">
                            <i class="fas fa-plus"></i> Buat Posko Baru
                        </a>
                    </label>
                    <small class="text-muted d-block mb-2">
                        Pilih posko yang akan menangani kejadian ini (bisa lebih dari satu).
                        Jika posko belum ada, buat terlebih dahulu di halaman Posko.
                    </small>
                    <select name="posko_id[]" id="posko_id" multiple class="form-control" style="height: auto;">
                        <option value="">Pilih Posko</option>
                        @foreach($poskoList as $posko)
                            <option value="{{ $posko->posko_id }}">
                                {{ $posko->nama }} - {{ $posko->penanggung_jawab }}
                                ({{ $posko->alamat }})
                                @if($posko->kejadian_id)
                                    <span class="text-danger">* Sedang menangani kejadian lain</span>
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @if($poskoList->isEmpty())
                    <div class="alert alert-warning mt-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        Belum ada data posko.
                        <a href="{{ route('posko.create') }}" class="alert-link">Klik di sini untuk membuat posko baru</a>
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="status_kejadian">Status Kejadian *</label>
                    <select id="status_kejadian" name="status_kejadian" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="dalam penanganan">Dalam Penanganan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan Tambahan</label>
                    <textarea id="keterangan" name="keterangan" placeholder="Informasi tambahan tentang kejadian ini"></textarea>
                </div>

                <!-- ✅ MULTIPLE FILE UPLOAD -  -->
                <div class="form-group mt-4">
                    <label class="fw-bold">Upload Foto Kejadian *</label>
                    <small class="text-muted d-block mb-2">
                        Format: JPG, PNG, GIF. Maksimal 2MB per file.
                    </small>

                    <!-- Input file multiple -->
                    <input type="file"
                           name="fotos[]"
                           class="form-control"
                           accept="image/*"
                           multiple
                           required>

                    <!-- Info file yang dipilih akan muncul otomatis di browser -->
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Simpan Data Kejadian
                </button>
            </form>
        </div>
    </div>
    {{-- END MAIN CONTENT  --}}
@endsection

@push('styles')
<style>
    .btn-add-small {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        background: var(--accent);
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.3s;
    }

    .btn-add-small:hover {
        background: #e67e22;
        color: white;
        text-decoration: none;
        transform: translateY(-1px);
    }
</style>
@endpush
