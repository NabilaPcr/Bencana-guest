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
                <h1><i class="fas fa-edit"></i> Edit Kejadian Bencana</h1>
                <p>Perbarui informasi kejadian bencana berikut</p>
            </div>

            <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}" method="POST" enctype="multipart/form-data"
                onsubmit="return validateForm()">
                @csrf
                @method('PUT')

                <!-- Informasi Kejadian -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="jenis_bencana" class="required">Jenis Bencana</label>
                        <input type="text" id="jenis_bencana" name="jenis_bencana"
                            class="form-control @error('jenis_bencana') is-invalid @enderror"
                            value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}"
                            placeholder="Contoh: Banjir, Gempa Bumi, Kebakaran" required>
                        @error('jenis_bencana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal" class="required">Tanggal Kejadian</label>
                                <input type="date" id="tanggal" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal', $kejadian->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_kejadian" class="required">Status Kejadian</label>
                                <select id="status_kejadian" name="status_kejadian"
                                    class="form-control @error('status_kejadian') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif"
                                        {{ old('status_kejadian', $kejadian->status_kejadian) == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="dalam penanganan"
                                        {{ old('status_kejadian', $kejadian->status_kejadian) == 'dalam penanganan' ? 'selected' : '' }}>
                                        Dalam Penanganan
                                    </option>
                                    <option value="selesai"
                                        {{ old('status_kejadian', $kejadian->status_kejadian) == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                </select>
                                @error('status_kejadian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lokasi Kejadian -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="lokasi_text" class="required">Alamat Lengkap</label>
                        <textarea id="lokasi_text" name="lokasi_text" rows="3"
                            class="form-control @error('lokasi_text') is-invalid @enderror"
                            placeholder="Deskripsikan lokasi kejadian dengan jelas (nama jalan, dusun, desa, dll)" required>{{ old('lokasi_text', $kejadian->lokasi_text) }}</textarea>
                        @error('lokasi_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="number" id="rt" name="rt" min="1" max="99"
                                    class="form-control @error('rt') is-invalid @enderror"
                                    value="{{ old('rt', $kejadian->rt) }}" placeholder="Contoh: 05">
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <input type="number" id="rw" name="rw" min="1" max="99"
                                    class="form-control @error('rw') is-invalid @enderror"
                                    value="{{ old('rw', $kejadian->rw) }}" placeholder="Contoh: 02">
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dampak & Keterangan -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="dampak" class="required">Dampak yang Terjadi</label>
                        <textarea id="dampak" name="dampak" rows="4" class="form-control @error('dampak') is-invalid @enderror"
                            placeholder="Deskripsikan dampak yang terjadi secara detail (kerusakan, korban, dll)" required>{{ old('dampak', $kejadian->dampak) }}</textarea>
                        @error('dampak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan Tambahan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                            class="form-control @error('keterangan') is-invalid @enderror"
                            placeholder="Informasi tambahan atau catatan khusus tentang kejadian ini">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- FIELD PEMILIHAN POSKO -->
                    <div class="form-group">
                        <label for="posko_id">
                            <i class="fas fa-first-aid"></i> Posko Penanganan

                        </label>
                        <small class="text-muted d-block mb-2">
                            Pilih posko yang akan menangani kejadian ini (bisa lebih dari satu).
                            Jika posko belum ada, buat terlebih dahulu di halaman Posko.
                        </small>
                        <select name="posko_id[]" id="posko_id" multiple
                            class="form-control @error('posko_id') is-invalid @enderror" style="height: auto;">
                            <option value="">Pilih Posko</option>
                            @foreach ($poskoList as $posko)
                                <option value="{{ $posko->posko_id }}" @if (in_array($posko->posko_id, $kejadian->posko->pluck('posko_id')->toArray())) selected @endif>
                                    {{ $posko->nama }} - {{ $posko->penanggung_jawab }}
                                    ({{ $posko->alamat }})
                                    @if ($posko->kejadian_id && !in_array($posko->posko_id, $kejadian->posko->pluck('posko_id')->toArray()))
                                        <span class="text-danger">* Sedang menangani kejadian lain</span>
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('posko_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Data Foto yang Sudah Tercatat -->
                    @if (isset($files) && $files->count() > 0)
                        <div class="form-section">
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
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <div class="d-flex justify-content-center align-items-center bg-light"
                                                                style="width: 60px; height: 60px;">
                                                                <img src="{{ asset('assets/img/placeholder.jpg') }}"
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
                                                    @if ($file->caption)
                                                        <small>{{ $file->caption }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $file->mime_type }}</td>
                                                <td>{{ $file->sort_order }}</td>
                                                <td>{{ $file->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="confirmDeleteSelected()">
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

                    <!-- Upload Foto Baru -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="fotos">Pilih File Foto</label>
                            <input type="file" name="fotos[]" id="fotos"
                                class="form-control @error('fotos') is-invalid @enderror" accept="image/*" multiple>
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                            </small>
                            @error('fotos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview Area -->
                        <div class="preview-area mt-3 d-none" id="previewArea">
                            <div class="row" id="previewContainer"></div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
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
            text-align: right;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            color: #56a65a;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            color: #2e6d38;
            text-decoration: underline;
        }

        .back-link i {
            margin-right: 8px;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h1 {
            color: #2e6d38;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #6c757d;
            margin-bottom: 0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Form validation
        function validateForm() {
            const jenisBencana = document.getElementById('jenis_bencana').value.trim();
            const tanggal = document.getElementById('tanggal').value;
            const lokasi = document.getElementById('lokasi_text').value.trim();
            const dampak = document.getElementById('dampak').value.trim();
            const status = document.getElementById('status_kejadian').value;

            if (!jenisBencana || !tanggal || !lokasi || !dampak || !status) {
                alert('Mohon lengkapi semua field yang wajib diisi!');
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
                return false;
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

                    // Validasi ukuran file (maksimal 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert(`File "${file.name}" melebihi ukuran maksimal 2MB`);
                        continue;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-sm-4 col-6 mb-3';

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

            // Set tanggal maksimal hari ini
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').max = today;
        });
    </script>
@endpush
