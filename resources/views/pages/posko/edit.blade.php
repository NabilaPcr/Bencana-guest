@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('posko.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Posko
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Posko Bencana</h1>
                <p>Perbarui informasi posko bencana berikut</p>
                <div class="alert alert-info d-flex align-items-center mt-3">
                    <i class="fas fa-info-circle fa-lg me-3"></i>
                    <div>
                        <strong>Perhatian:</strong> Data yang sudah tersimpan tidak dapat dikembalikan.
                        Pastikan semua informasi sudah benar sebelum menyimpan.
                    </div>
                </div>
            </div>

            <form action="{{ route('posko.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data"
                  onsubmit="return validateForm()">
                @csrf
                @method('PUT')

                <!-- Informasi Posko -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                    </h4>

                    <div class="form-group">
                        <label for="nama" class="required">Nama Posko</label>
                        <input type="text" id="nama" name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $posko->nama) }}"
                               placeholder="Contoh: Posko Pengungsian Pusat" required>
                        @error('nama')
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
                                    @foreach($kejadianList as $kejadian)
                                        <option value="{{ $kejadian->kejadian_id }}"
                                            {{ old('kejadian_id', $posko->kejadian_id) == $kejadian->kejadian_id ? 'selected' : '' }}>
                                            {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }} ({{ $kejadian->tanggal->format('d/m/Y') }})
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
                                <label for="penanggung_jawab" class="required">Penanggung Jawab</label>
                                <input type="text" id="penanggung_jawab" name="penanggung_jawab"
                                       class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                       value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}"
                                       placeholder="Nama penanggung jawab" required>
                                @error('penanggung_jawab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Alamat -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-address-card me-2"></i>Kontak & Lokasi
                    </h4>

                    <div class="form-group">
                        <label for="alamat" class="required">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Alamat lengkap posko (nama jalan, RT/RW, kelurahan, kecamatan)"
                                  required>{{ old('alamat', $posko->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kontak" class="required">Kontak</label>
                        <input type="text" id="kontak" name="kontak"
                               class="form-control @error('kontak') is-invalid @enderror"
                               value="{{ old('kontak', $posko->kontak) }}"
                               placeholder="Contoh: 081234567890" required>
                        @error('kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Nomor telepon/WA yang dapat dihubungi</small>
                    </div>
                </div>

                <!-- DATA FOTO YANG SUDAH TERCATAT -->
                @php
                    $files = $posko->getMediaFiles(); // Menggunakan method dari model
                @endphp

                @if($files->count() > 0)
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-database me-2"></i>Data Foto Tercatat
                            <span class="badge bg-primary ms-2">{{ $files->count() }} data</span>
                        </h4>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Data berikut hanya mencatat bahwa posko ini memiliki foto. File asli belum diupload.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll()">
                                        </th>
                                        <th>Nama File</th>
                                        <th>Keterangan</th>
                                        <th>Tipe</th>
                                        <th>Urutan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="delete_media[]"
                                                       value="{{ $file->media_id }}"
                                                       class="delete-checkbox">
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="d-flex justify-content-center align-items-center bg-light"
                                                             style="width: 60px; height: 60px;">
                                                            <img src="{{ $posko->getImageUrl($file->file_name) }}"
                                                                 alt="Placeholder"
                                                                 style="width: 80%; height: auto; opacity: 0.6;">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $file->file_name }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($file->caption)
                                                    <small>{{ $file->caption }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $file->mime_type }}</td>
                                            <td>{{ $file->sort_order }}</td>
                                            <td>{{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($posko->isPlaceholder($file->file_name))
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-exclamation-triangle me-1"></i> Placeholder
                                                    </span>
                                                @else
                                                    @php
                                                        $path = 'storage/uploads/posko_bencana/' . $file->file_name;
                                                        $fileExists = file_exists(public_path($path));
                                                    @endphp
                                                    @if($fileExists)
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check me-1"></i> File Ada
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-times me-1"></i> File Hilang
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDeleteSelected()">
                                    <i class="fas fa-trash me-1"></i>
                                    Hapus Data Terpilih
                                </button>
                            </div>
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Centang data yang ingin dihapus
                            </div>
                        </div>
                    </div>
                @endif

                <!-- UPLOAD FOTO BARU -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Foto Asli
                    </h4>

                    <div class="alert alert-success">
                        <i class="fas fa-lightbulb me-2"></i>
                        Upload foto asli untuk menggantikan placeholder dan memiliki dokumentasi yang lengkap.
                    </div>

                    <div class="form-group">
                        <label for="fotos">Pilih File Foto</label>
                        <input type="file" name="fotos[]" id="fotos"
                               class="form-control @error('fotos') is-invalid @enderror"
                               accept="image/*" multiple>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Pilih file gambar (JPG, PNG, GIF). Maksimal 2MB per file. Bisa pilih multiple file.
                        </small>
                        @error('fotos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview Area -->
                    <div class="preview-area mt-3 d-none" id="previewArea">
                        <h6 class="mb-3">
                            <i class="fas fa-eye me-2"></i>Preview File yang Dipilih
                        </h6>
                        <div class="row" id="previewContainer"></div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posko.show', $posko->posko_id) }}"
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
@endsection

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

    .delete-checkbox:checked {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .preview-area {
        border: 2px dashed #56a65a;
        border-radius: 10px;
        padding: 20px;
        background: #f9fff9;
    }

    .preview-item {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .preview-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }

    .form-actions {
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
        margin-top: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
// Form validation
function validateForm() {
    const nama = document.getElementById('nama').value.trim();
    const kejadian = document.getElementById('kejadian_id').value;
    const penanggungJawab = document.getElementById('penanggung_jawab').value.trim();
    const alamat = document.getElementById('alamat').value.trim();
    const kontak = document.getElementById('kontak').value.trim();

    if (!nama || !kejadian || !penanggungJawab || !alamat || !kontak) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }

    // Validasi nomor telepon
    const phoneRegex = /^[0-9]{10,13}$/;
    if (!phoneRegex.test(kontak.replace(/\D/g, ''))) {
        alert('Nomor kontak harus 10-13 digit angka!');
        return false;
    }

    return true;
}

// Toggle select all checkboxes
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.delete-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

// Confirm delete selected
function confirmDeleteSelected() {
    const checked = document.querySelectorAll('.delete-checkbox:checked');

    if (checked.length === 0) {
        alert('Pilih data yang ingin dihapus terlebih dahulu!');
        return;
    }

    if (confirm(`Yakin ingin menghapus ${checked.length} data terpilih?`)) {
        return true;
    }

    return false;
}

// Preview selected files
document.getElementById('fotos').addEventListener('change', function(e) {
    const previewArea = document.getElementById('previewArea');
    const previewContainer = document.getElementById('previewContainer');
    const files = e.target.files;

    previewContainer.innerHTML = '';

    if (files.length > 0) {
        previewArea.classList.remove('d-none');

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-sm-4 col-6';

                col.innerHTML = `
                    <div class="preview-item">
                        <img src="${e.target.result}" alt="Preview ${i + 1}">
                        <div class="p-2 text-center bg-light">
                            <small class="d-block text-truncate">${file.name}</small>
                            <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                        </div>
                    </div>
                `;

                previewContainer.appendChild(col);
            };

            reader.readAsDataURL(file);
        }
    } else {
        previewArea.classList.add('d-none');
    }
});

// Auto-focus first invalid field
document.addEventListener('DOMContentLoaded', function() {
    const invalidFields = document.querySelectorAll('.is-invalid');
    if (invalidFields.length > 0) {
        invalidFields[0].focus();
    }
});
</script>
@endpush
