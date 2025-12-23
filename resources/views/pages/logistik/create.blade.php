@extends('layout.guest.app')
@section('title', 'Tambah Logistik Bencana')

@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('logistik.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Logistik
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-plus-circle"></i> Tambah Logistik Bencana</h1>
            <p>Isi form berikut untuk menambahkan data logistik baru</p>
        </div>

        <form action="{{ route('logistik.store') }}" method="POST">
            @csrf

            <!-- Kejadian Bencana -->
            <div class="form-group">
                <label for="kejadian_id">Kejadian Bencana *</label>
                <select id="kejadian_id" name="kejadian_id" required>
                    <option value="">Pilih Kejadian Bencana</option>
                    @foreach($kejadians as $kejadian)
                        <option value="{{ $kejadian->kejadian_id }}"
                            {{ old('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                            {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                            ({{ \Carbon\Carbon::parse($kejadian->tanggal)->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                @error('kejadian_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang *</label>
                <input type="text" id="nama_barang" name="nama_barang" required
                       value="{{ old('nama_barang') }}"
                       placeholder="Contoh: Beras, Air Mineral, Obat-obatan">
                @error('nama_barang')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Satuan dan Stok -->
            <div class="form-row">
                <div class="form-group">
                    <label for="satuan">Satuan *</label>
                    <select id="satuan" name="satuan" required>
                        <option value="">Pilih Satuan</option>
                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>liter</option>
                        <option value="buah" {{ old('satuan') == 'buah' ? 'selected' : '' }}>buah</option>
                        <option value="dus" {{ old('satuan') == 'dus' ? 'selected' : '' }}>dus</option>
                        <option value="pak" {{ old('satuan') == 'pak' ? 'selected' : '' }}>pak</option>
                        <option value="karung" {{ old('satuan') == 'karung' ? 'selected' : '' }}>karung</option>
                        <option value="botol" {{ old('satuan') == 'botol' ? 'selected' : '' }}>botol</option>
                        <option value="kaleng" {{ old('satuan') == 'kaleng' ? 'selected' : '' }}>kaleng</option>
                        <option value="kardus" {{ old('satuan') == 'kardus' ? 'selected' : '' }}>kardus</option>
                        <option value="unit" {{ old('satuan') == 'unit' ? 'selected' : '' }}>unit</option>
                    </select>
                    @error('satuan')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Jumlah Stok *</label>
                    <input type="number" id="stok" name="stok"
                           value="{{ old('stok', 0) }}"
                           min="0" step="1" required>
                    @error('stok')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Sumber -->
            <div class="form-group">
                <label for="sumber">Sumber</label>
                <input type="text" id="sumber" name="sumber"
                       value="{{ old('sumber') }}"
                       placeholder="Contoh: Bantuan Pemerintah, Donasi Masyarakat, Swasta">
                @error('sumber')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="action-buttons">
                <a href="{{ route('logistik.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit btn-submit-full">
                    <i class="fas fa-save"></i> Simpan Logistik
                </button>
            </div>
        </form>
    </div>
</div>
<!-- END MAIN CONTENT -->

<script>
    // Auto select satuan based on barang name
    document.getElementById('nama_barang').addEventListener('input', function(e) {
        const barangName = e.target.value.toLowerCase();
        const satuanSelect = document.getElementById('satuan');

        if (barangName.includes('beras') || barangName.includes('gula') || barangName.includes('tepung') || barangName.includes('sembako')) {
            satuanSelect.value = 'kg';
        } else if (barangName.includes('air') || barangName.includes('minyak') || barangName.includes('bahan bakar')) {
            satuanSelect.value = 'liter';
        } else if (barangName.includes('obat') || barangName.includes('masker') || barangName.includes('alat kesehatan')) {
            satuanSelect.value = 'pak';
        } else if (barangName.includes('botol') || barangName.includes('minuman')) {
            satuanSelect.value = 'botol';
        } else if (barangName.includes('selimut') || barangName.includes('pakaian') || barangName.includes('handuk')) {
            satuanSelect.value = 'buah';
        } else if (barangName.includes('mie') || barangName.includes('biskuit') || barangName.includes('makanan instan')) {
            satuanSelect.value = 'dus';
        }
    });
</script>
@endsection
