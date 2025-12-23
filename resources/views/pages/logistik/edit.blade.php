@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('logistik.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Logistik
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-edit"></i> Edit Data Logistik</h1>
            <p>Perbarui informasi logistik bencana berikut</p>
            <div class="alert alert-info d-flex align-items-center mt-3">
                <i class="fas fa-info-circle fa-lg me-3"></i>
                <div>
                    <strong>Perhatian:</strong> Data yang sudah tersimpan tidak dapat dikembalikan.
                    Pastikan semua informasi sudah benar sebelum menyimpan.
                </div>
            </div>
        </div>

        <form action="{{ route('logistik.update', $logistik->logistik_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Informasi Logistik -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                </h4>

                <div class="form-group">
                    <label for="nama_barang" class="required">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang"
                           class="form-control @error('nama_barang') is-invalid @enderror"
                           value="{{ old('nama_barang', $logistik->nama_barang) }}"
                           placeholder="Contoh: Beras, Air Mineral, Obat-obatan" required>
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kejadian_id" class="required">Kejadian Bencana</label>
                            <select id="kejadian_id" name="kejadian_id"
                                    class="form-control @error('kejadian_id') is-invalid @enderror" required>
                                <option value="">Pilih Kejadian Bencana</option>
                                @foreach($kejadians as $kejadian)
                                    <option value="{{ $kejadian->kejadian_id }}"
                                        {{ old('kejadian_id', $logistik->kejadian_id) == $kejadian->kejadian_id ? 'selected' : '' }}>
                                        {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                        ({{ $kejadian->tanggal->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kejadian_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="satuan" class="required">Satuan</label>
                            <select id="satuan" name="satuan"
                                    class="form-control @error('satuan') is-invalid @enderror" required>
                                <option value="">Pilih Satuan</option>
                                <option value="kg" {{ old('satuan', $logistik->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                                <option value="liter" {{ old('satuan', $logistik->satuan) == 'liter' ? 'selected' : '' }}>liter</option>
                                <option value="buah" {{ old('satuan', $logistik->satuan) == 'buah' ? 'selected' : '' }}>buah</option>
                                <option value="dus" {{ old('satuan', $logistik->satuan) == 'dus' ? 'selected' : '' }}>dus</option>
                                <option value="pak" {{ old('satuan', $logistik->satuan) == 'pak' ? 'selected' : '' }}>pak</option>
                                <option value="karung" {{ old('satuan', $logistik->satuan) == 'karung' ? 'selected' : '' }}>karung</option>
                                <option value="botol" {{ old('satuan', $logistik->satuan) == 'botol' ? 'selected' : '' }}>botol</option>
                                <option value="kaleng" {{ old('satuan', $logistik->satuan) == 'kaleng' ? 'selected' : '' }}>kaleng</option>
                                <option value="kardus" {{ old('satuan', $logistik->satuan) == 'kardus' ? 'selected' : '' }}>kardus</option>
                                <option value="unit" {{ old('satuan', $logistik->satuan) == 'unit' ? 'selected' : '' }}>unit</option>
                            </select>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah & Sumber -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-calculator me-2"></i>Jumlah & Sumber
                </h4>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok" class="required">Stok Tersedia</label>
                            <input type="number" id="stok" name="stok"
                                   class="form-control @error('stok') is-invalid @enderror"
                                   value="{{ old('stok', $logistik->stok) }}"
                                   min="0" step="1" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jumlah barang yang tersedia saat ini</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sumber">Sumber Logistik</label>
                            <input type="text" id="sumber" name="sumber"
                                   class="form-control @error('sumber') is-invalid @enderror"
                                   value="{{ old('sumber', $logistik->sumber) }}"
                                   placeholder="Contoh: Bantuan Pemerintah, Donasi Masyarakat">
                            @error('sumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Asal sumber logistik (opsional)</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Stok -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="fas fa-chart-line me-2"></i>Status Stok
                </h4>

                <div class="alert alert-light">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @if($logistik->stok > 50)
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            @elseif($logistik->stok > 10)
                                <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                            @else
                                <i class="fas fa-times-circle fa-2x text-danger"></i>
                            @endif
                        </div>
                        <div>
                            <strong>Status Saat Ini:</strong>
                            @if($logistik->stok > 50)
                                <span class="text-success">Stok Cukup</span>
                            @elseif($logistik->stok > 10)
                                <span class="text-warning">Stok Menipis</span>
                            @else
                                <span class="text-danger">Stok Kritis</span>
                            @endif
                            <br>
                            <small class="text-muted">
                                Jumlah stok saat ini: <strong>{{ $logistik->stok }} {{ $logistik->satuan }}</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('logistik.show', $logistik->logistik_id) }}"
                       class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END MAIN CONTENT -->

@push('styles')
<style>
    .required:after {
        content: " *";
        color: #e74c3c;
    }

    .form-section {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 25px;
    }

    .section-title {
        color: #2e6d38;
        border-bottom: 2px solid #56a65a;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .form-control:focus {
        border-color: #56a65a;
        box-shadow: 0 0 0 0.2rem rgba(86, 166, 90, 0.25);
    }

    .form-actions {
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
        margin-top: 20px;
    }

    .alert-light {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
// Form validation
function validateForm() {
    const namaBarang = document.getElementById('nama_barang').value.trim();
    const kejadian = document.getElementById('kejadian_id').value;
    const satuan = document.getElementById('satuan').value;
    const stok = document.getElementById('stok').value.trim();

    if (!namaBarang || !kejadian || !satuan || !stok) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }

    // Validasi stok
    if (parseInt(stok) < 0) {
        alert('Stok tidak boleh negatif!');
        return false;
    }

    return true;
}

// Auto-focus first invalid field
document.addEventListener('DOMContentLoaded', function() {
    const invalidFields = document.querySelectorAll('.is-invalid');
    if (invalidFields.length > 0) {
        invalidFields[0].focus();
    }
});

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
@endpush
@endsection
