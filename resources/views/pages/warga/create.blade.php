@extends('layout.guest.app')
@section('content')
     <!-- MAIN CONTENT -->
    <div class="container">
    <a href="{{ route('warga.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Warga
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-user-plus"></i> Form Laporan Warga</h1>
            <p>Laporan warga yang terdampak oleh bencana! Silahkan isi form berikut untuk mengisi informasi warga.</p>
        </div>

        <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama Lengkap *</label>
                    <input type="text" id="nama" name="nama" required
                           placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                </div>

                <div class="form-group">
                    <label for="no_ktp">No KTP *</label>
                    <input type="text" id="no_ktp" name="no_ktp" required
                           placeholder="Masukkan No KTP" value="{{ old('no_ktp') }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin *</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="agama">Agama *</label>
                    <input type="text" id="agama" name="agama" required
                           placeholder="Masukkan agama" value="{{ old('agama') }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan *</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" required
                           placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}">
                </div>

                <div class="form-group">
                    <label for="telp">No Telepon *</label>
                    <input type="tel" id="telp" name="telp" required
                           placeholder="Masukkan nomor telepon" value="{{ old('telp') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       placeholder="Masukkan email (opsional)" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required
                          placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="rt">RT *</label>
                    <input type="text" id="rt" name="rt" required
                           placeholder="Masukkan RT" value="{{ old('rt') }}">
                </div>

                <div class="form-group">
                    <label for="rw">RW *</label>
                    <input type="text" id="rw" name="rw" required
                           placeholder="Masukkan RW" value="{{ old('rw') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                <textarea id="kebutuhan_khusus" name="kebutuhan_khusus"
                          placeholder="Masukkan kebutuhan khusus warga (opsional)">{{ old('kebutuhan_khusus') }}</textarea>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan"
                          placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
            </div>


            <div class="form-group">
                <label for="fotos">Pilih Foto</label>
                <input type="file" name="fotos[]" id="fotos"
                       class="form-control" accept="image/*" multiple>
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Pilih file gambar (JPG, PNG, GIF). Maksimal 2MB per file. Bisa pilih multiple file.
                </small>
            </div>

            <!-- Preview Area -->
            <div class="preview-area mt-3 d-none" id="previewArea">
                <h6 class="mb-3">
                    <i class="fas fa-eye me-2"></i>Preview File yang Dipilih
                </h6>
                <div class="row" id="previewContainer"></div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Kirim Laporan Warga
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
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
                    col.className = 'col-md-3 col-sm-4 col-6 mb-3';

                    col.innerHTML = `
                    <div class="preview-item border rounded p-2">
                        <img src="${e.target.result}" alt="Preview ${i + 1}"
                             class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                        <div class="p-1 text-center bg-light mt-1">
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
</script>
@endpush

@push('styles')
<style>
    .preview-area {
        border: 2px dashed #56a65a;
        border-radius: 10px;
        padding: 20px;
        background: #f9fff9;
    }

    .preview-item {
        transition: transform 0.3s;
    }

    .preview-item:hover {
        transform: translateY(-2px);
    }
</style>
@endpush
@endsection
