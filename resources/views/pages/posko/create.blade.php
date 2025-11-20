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

            <div class="form-group">
                <label for="posko_id">ID Posko *</label>
                <input type="text" id="posko_id" name="posko_id" required
                       value="{{ old('posko_id') }}"
                       placeholder="Contoh: POSKO-001">
            </div>

            <div class="form-group">
                <label for="kejadian_id">Kejadian Bencana *</label>
                <select id="kejadian_id" name="kejadian_id" required>
                    <option value="">Pilih Kejadian Bencana</option>
                    @foreach($kejadianList as $kejadian)
                        <option value="{{ $kejadian->kejadian_id }}"
                            {{ old('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                            {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }} ({{ $kejadian->tanggal->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama Posko *</label>
                <input type="text" id="nama" name="nama" required
                       value="{{ old('nama') }}"
                       placeholder="Contoh: Posko Pengungsian Pusat">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required
                          placeholder="Alamat lengkap posko">{{ old('alamat') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="kontak">Kontak *</label>
                    <input type="text" id="kontak" name="kontak" required
                           value="{{ old('kontak') }}"
                           placeholder="Contoh: 081234567890">
                </div>

                <div class="form-group">
                    <label for="penanggung_jawab">Penanggung Jawab *</label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab" required
                           value="{{ old('penanggung_jawab') }}"
                           placeholder="Nama penanggung jawab">
                </div>
            </div>

            {{-- <div class="form-group">
                <label for="media">Media</label>
                <input type="text" id="media" name="media"
                       value="{{ old('media') }}"
                       placeholder="Contoh: Instagram, Facebook, dll">
            </div> --}}

            {{-- <div class="form-group">
                <label for="foto">Foto Posko</label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <small class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
            </div> --}}

            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data Posko
            </button>
        </form>
    </div>
</div>
{{-- END MAIN CONTENT --}}
@endsection
