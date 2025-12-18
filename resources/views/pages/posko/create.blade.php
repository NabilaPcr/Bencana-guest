@extends('layout.guest.app')
@section('title', 'Tambah Posko Bencana')

@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('posko.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Posko
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-plus-circle"></i> Tambah Posko Bencana</h1>
            <p>Isi form berikut untuk menambahkan posko bencana baru</p>
        </div>

        <form action="{{ route('posko.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- HAPUS FIELD posko_id karena auto increment -->
            <!-- <div class="form-group">
                <label for="posko_id">ID Posko *</label>
                <input type="text" id="posko_id" name="posko_id" required
                       value="{{ old('posko_id') }}"
                       placeholder="Contoh: POSKO-001">
                @error('posko_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div> -->

            <div class="form-group">
                <label for="kejadian_id">Kejadian Bencana *</label>
                <select id="kejadian_id" name="kejadian_id" required>
                    <option value="">Pilih Kejadian Bencana</option>
                    @foreach($kejadianList as $kejadian)
                        <option value="{{ $kejadian->kejadian_id }}"
                            {{ old('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                            {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }} ({{ \Carbon\Carbon::parse($kejadian->tanggal)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                @error('kejadian_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Posko *</label>
                <input type="text" id="nama" name="nama" required
                       value="{{ old('nama') }}"
                       placeholder="Contoh: Posko Pengungsian Pusat">
                @error('nama')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required
                          placeholder="Alamat lengkap posko">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kontak">Kontak *</label>
                    <input type="text" id="kontak" name="kontak" required
                           value="{{ old('kontak') }}"
                           placeholder="Contoh: 081234567890">
                    @error('kontak')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="penanggung_jawab">Penanggung Jawab *</label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab" required
                           value="{{ old('penanggung_jawab') }}"
                           placeholder="Nama penanggung jawab">
                    @error('penanggung_jawab')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- ✅ MULTIPLE FILE UPLOAD UNTUK POSKO -->
            <div class="form-group mt-4">
                <label class="fw-bold">Upload Foto Posko *</label>
                <small class="text-muted d-block mb-2">
                    Format: JPG, PNG, GIF. Maksimal 2MB per file.
                    <br>Tekan <kbd>Ctrl</kbd> (Windows) atau <kbd>Cmd</kbd> (Mac) untuk memilih multiple file.
                </small>

                <!-- Input file multiple -->
                <input type="file"
                       name="fotos[]"
                       class="form-control"
                       accept="image/*"
                       multiple
                       required>

                @error('fotos')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
                @error('fotos.*')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data Posko
            </button>
        </form>
    </div>
</div>
{{-- END MAIN CONTENT --}}
@endsection
