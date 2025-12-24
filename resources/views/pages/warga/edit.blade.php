@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    {{-- <div class="container">
    <a href="{{ route('warga.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Warga
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-edit"></i> Edit Data Warga</h1>
            <p>Perbarui data warga berikut</p>
        </div>

        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="no_ktp">Nomor KTP *</label>
                <input type="text" id="no_ktp" name="no_ktp" required
                       value="{{ old('no_ktp', $warga->no_ktp) }}"
                       placeholder="Masukkan nomor KTP">
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" required
                       value="{{ old('nama', $warga->nama) }}"
                       placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin *</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="agama">Agama *</label>
                    <input type="text" id="agama" name="agama" required
                           value="{{ old('agama', $warga->agama) }}"
                           placeholder="Contoh: Islam, Kristen, dll">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan *</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" required
                           value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                           placeholder="Contoh: Wiraswasta, PNS, dll">
                </div>

                <div class="form-group">
                    <label for="telp">Nomor Telepon *</label>
                    <input type="text" id="telp" name="telp" required
                           value="{{ old('telp', $warga->telp) }}"
                           placeholder="Contoh: 081234567890">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $warga->email) }}"
                       placeholder="Contoh: contoh@email.com">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required
                          placeholder="Masukkan alamat lengkap">{{ old('alamat', $warga->alamat) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="rt">RT *</label>
                    <input type="text" id="rt" name="rt" required
                           value="{{ old('rt', $warga->rt) }}"
                           placeholder="Contoh: 05">
                </div>

                <div class="form-group">
                    <label for="rw">RW *</label>
                    <input type="text" id="rw" name="rw" required
                           value="{{ old('rw', $warga->rw) }}"
                           placeholder="Contoh: 02">
                </div>
            </div>

            <div class="form-group">
                <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                <textarea id="kebutuhan_khusus" name="kebutuhan_khusus"
                          placeholder="Contoh: Butuh obat diabetes, makanan khusus, dll">{{ old('kebutuhan_khusus', $warga->kebutuhan_khusus) }}</textarea>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan"
                          placeholder="Informasi tambahan tentang warga">{{ old('keterangan', $warga->keterangan) }}</textarea>
            </div>

            <div class="action-buttons">
                <a href="{{ route('warga.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit btn-submit-full">
                    <i class="fas fa-save"></i> Update Data Warga
                </button>
            </div>
        </form>
    </div>
</div> --}}

<div class="container">
    <a href="{{ route('warga.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Warga
    </a>

    <div class="form-card">
        <div class="form-header">
            <h1><i class="fas fa-edit"></i> Edit Data Warga</h1>
            <p>Perbarui data warga berikut</p>
        </div>

        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div class="form-group">
                <label for="no_ktp">Nomor KTP *</label>
                <input type="text" id="no_ktp" name="no_ktp" required
                       value="{{ old('no_ktp', $warga->no_ktp) }}"
                       placeholder="Masukkan nomor KTP">
            </div> --}}

            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" required
                       value="{{ old('nama', $warga->nama) }}"
                       placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin *</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="agama">Agama *</label>
                    <input type="text" id="agama" name="agama" required
                           value="{{ old('agama', $warga->agama) }}"
                           placeholder="Contoh: Islam, Kristen, dll">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan *</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" required
                           value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                           placeholder="Contoh: Wiraswasta, PNS, dll">
                </div>

                <div class="form-group">
                    <label for="telp">Nomor Telepon *</label>
                    <input type="text" id="telp" name="telp" required
                           value="{{ old('telp', $warga->telp) }}"
                           placeholder="Contoh: 081234567890">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $warga->email) }}"
                       placeholder="Contoh: contoh@email.com">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Lengkap *</label>
                <textarea id="alamat" name="alamat" required
                          placeholder="Masukkan alamat lengkap">{{ old('alamat', $warga->alamat) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="rt">RT *</label>
                    <input type="text" id="rt" name="rt" required
                           value="{{ old('rt', $warga->rt) }}"
                           placeholder="Contoh: 05">
                </div>

                <div class="form-group">
                    <label for="rw">RW *</label>
                    <input type="text" id="rw" name="rw" required
                           value="{{ old('rw', $warga->rw) }}"
                           placeholder="Contoh: 02">
                </div>
            </div>
            <div class="form-group">
                <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                <textarea id="kebutuhan_khusus" name="kebutuhan_khusus"
                          placeholder="Contoh: Butuh obat diabetes, makanan khusus, dll">{{ old('kebutuhan_khusus', $warga->kebutuhan_khusus) }}</textarea>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan"
                          placeholder="Informasi tambahan tentang warga">{{ old('keterangan', $warga->keterangan) }}</textarea>
            </div>

            <!-- DATA FOTO YANG SUDAH TERCATAT -->
            {{-- @if ($files->count() > 0)
                <h3 class="section-title"><i class="fas fa-images"></i> Foto yang Telah Diupload</h3>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Total: {{ $files->count() }} foto tercatat
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll()">
                                </th>
                                <th>Preview</th>
                                <th>Nama File</th>
                                <th>Keterangan</th>
                                <th>Tipe</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="delete_media[]"
                                            value="{{ $file->media_id }}" class="delete-checkbox">
                                    </td>
                                    <td>
                                        <div style="width: 60px; height: 60px; overflow: hidden; border-radius: 5px;">
                                            @php
                                                $filePath = 'storage/warga_fotos/' . $file->file_name;
                                                $fileExists = file_exists(public_path($filePath));
                                            @endphp
                                            @if($fileExists)
                                                <img src="{{ asset($filePath) }}" alt="{{ $file->file_name }}"
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex justify-content-center align-items-center bg-light h-100">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $file->file_name }}</td>
                                    <td>
                                        @if ($file->caption)
                                            <small>{{ $file->caption }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $file->mime_type }}</td>
                                    <td>{{ $file->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            onclick="confirmDeleteSelected()">
                            <i class="fas fa-trash me-1"></i>
                            Hapus Foto Terpilih
                        </button>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Centang foto yang ingin dihapus
                    </div>
                </div>
            @endif

            <!-- UPLOAD FOTO BARU -->
            <h3 class="section-title"><i class="fas fa-camera"></i> Upload Foto Baru</h3>

            <div class="form-group">
                <label for="fotos">Pilih Foto Baru</label>
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
            </div> --}}

            <div class="action-buttons mt-4">
                <a href="{{ route('warga.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-submit btn-submit-full">
                    <i class="fas fa-save"></i> Update Data Warga
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
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
            alert('Pilih foto yang ingin dihapus terlebih dahulu!');
            return;
        }

        if (confirm(`Yakin ingin menghapus ${checked.length} foto terpilih?`)) {
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

    .delete-checkbox:checked {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
</style>
@endpush
@endsection
