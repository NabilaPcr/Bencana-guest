@extends('layout.guest.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('distribusi.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Distribusi
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Distribusi Logistik</h1>
                <p>Perbarui informasi distribusi logistik berikut</p>
            </div>

            <form action="{{ route('distribusi.update', $distribusi->distribusi_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Logistik -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-box me-2"></i>Informasi Logistik
                    </h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logistik_id" class="required">Logistik Bencana</label>
                                <select id="logistik_id" name="logistik_id" class="form-control @error('logistik_id') is-invalid @enderror" required>
                                    <option value="">Pilih Logistik</option>
                                    @foreach($logistik as $item)
                                        <option value="{{ $item->logistik_id }}"
                                            {{ old('logistik_id', $distribusi->logistik_id) == $item->logistik_id ? 'selected' : '' }}
                                            data-stok="{{ $item->stok }}"
                                            data-satuan="{{ $item->satuan }}">
                                            {{ $item->nama_barang }} (Stok: {{ $item->stok }} {{ $item->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('logistik_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="posko_id" class="required">Posko Tujuan</label>
                                <select id="posko_id" name="posko_id" class="form-control @error('posko_id') is-invalid @enderror" required>
                                    <option value="">Pilih Posko</option>
                                    @foreach($posko as $item)
                                        <option value="{{ $item->posko_id }}"
                                            {{ old('posko_id', $distribusi->posko_id) == $item->posko_id ? 'selected' : '' }}>
                                            {{ $item->nama }} - {{ $item->kejadian->jenis_bencana ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('posko_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Distribusi -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-info-circle me-2"></i>Detail Distribusi
                    </h4>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal" class="required">Tanggal Distribusi</label>
                                <input type="date" id="tanggal" name="tanggal"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', $distribusi->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jumlah" class="required">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlah" min="1"
                                       class="form-control @error('jumlah') is-invalid @enderror"
                                       value="{{ old('jumlah', $distribusi->jumlah) }}" required>
                                <small class="text-muted" id="stok-info">Stok tersedia: -</small>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="penerima" class="required">Penerima</label>
                                <input type="text" id="penerima" name="penerima"
                                       class="form-control @error('penerima') is-invalid @enderror"
                                       value="{{ old('penerima', $distribusi->penerima) }}" required>
                                @error('penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lokasi">Lokasi Distribusi</label>
                                <input type="text" id="lokasi" name="lokasi"
                                       class="form-control @error('lokasi') is-invalid @enderror"
                                       value="{{ old('lokasi', $distribusi->lokasi) }}"
                                       placeholder="Lokasi penyaluran">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" id="satuan" name="satuan" readonly
                                       class="form-control bg-light"
                                       placeholder="Satuan akan terisi otomatis">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                                  class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $distribusi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- DATA BUKTI DISTRIBUSI YANG SUDAH TERCATAT -->
                @if($distribusi->getMediaFiles()->count() > 0)
                    <div class="form-section">
                        <h4 class="section-title">
                            <i class="fas fa-database me-2"></i>Data Bukti Distribusi Tercatat
                            <span class="badge bg-primary ms-2">{{ $distribusi->getMediaFiles()->count() }} data</span>
                        </h4>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll" onclick="toggleSelectAll()">
                                        </th>
                                        <th>Preview</th>
                                        <th>Nama File</th>
                                        <th>Tipe</th>
                                        <th>Ukuran</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($distribusi->getMediaFiles() as $file)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="delete_media[]"
                                                    value="{{ $file->media_id }}" class="delete-checkbox">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center bg-light"
                                                    style="width: 60px; height: 60px;">
                                                    <img src="{{ $distribusi->getImageUrl($file->file_name) }}"
                                                        alt="{{ $file->file_name }}"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            </td>
                                            <td>
                                                <strong>{{ $file->file_name }}</strong>
                                            </td>
                                            <td>{{ $file->mime_type }}</td>
                                            <td>
                                                @if($file->file_size)
                                                    {{ round($file->file_size / 1024, 2) }} KB
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}</td>
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
                                    Hapus Bukti Terpilih
                                </button>
                            </div>
                            <div class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Centang data yang ingin dihapus
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Upload Bukti Distribusi Baru -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-camera me-2"></i>Upload Bukti Distribusi Baru
                    </h4>

                    <div class="form-group">
                        <label for="bukti_distribusi">Pilih File Bukti</label>
                        <input type="file" name="bukti_distribusi[]" id="bukti_distribusi"
                            class="form-control @error('bukti_distribusi') is-invalid @enderror"
                            accept="image/*" multiple>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Pilih file gambar (JPG, PNG, GIF). Maksimal 2MB per file. Maksimal 5 file.
                        </small>
                        @error('bukti_distribusi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('bukti_distribusi.*')
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

                <!-- Warning jika stok tidak mencukupi -->
                <div class="alert alert-warning d-none" id="stok-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="warning-text"></span>
                </div>

                <div class="form-actions">
                    <div>
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
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

        #stok-info {
            display: block;
            margin-top: 5px;
            font-size: 0.875rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Update info stok ketika logistik dipilih
        document.getElementById('logistik_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const stok = selectedOption.getAttribute('data-stok');
            const satuan = selectedOption.getAttribute('data-satuan');

            document.getElementById('stok-info').textContent = `Stok tersedia: ${stok} ${satuan}`;
            document.getElementById('satuan').value = satuan;

            // Update warning jika jumlah melebihi stok
            updateStokWarning();
        });

        // Validasi jumlah tidak melebihi stok
        document.getElementById('jumlah').addEventListener('input', updateStokWarning);

        function updateStokWarning() {
            const logistikSelect = document.getElementById('logistik_id');
            const jumlahInput = document.getElementById('jumlah');
            const warningDiv = document.getElementById('stok-warning');
            const warningText = document.getElementById('warning-text');
            const submitBtn = document.getElementById('submit-btn');

            if (logistikSelect.value && jumlahInput.value) {
                const selectedOption = logistikSelect.options[logistikSelect.selectedIndex];
                const stok = parseInt(selectedOption.getAttribute('data-stok'));
                const jumlah = parseInt(jumlahInput.value);
                const satuan = selectedOption.getAttribute('data-satuan');

                // Untuk edit, perlu menambahkan stok yang akan dikembalikan
                const originalStok = {{ $distribusi->logistik_id == $distribusi->logistik_id ? $distribusi->logistik->stok + $distribusi->jumlah : 0 }};

                if (jumlah > stok) {
                    warningDiv.classList.remove('d-none');
                    warningText.textContent = `Jumlah (${jumlah} ${satuan}) melebihi stok tersedia (${stok} ${satuan}).`;
                    submitBtn.disabled = true;
                    submitBtn.classList.add('btn-secondary');
                    submitBtn.classList.remove('btn-primary');
                } else {
                    warningDiv.classList.add('d-none');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('btn-secondary');
                    submitBtn.classList.add('btn-primary');
                }
            }
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
                alert('Pilih bukti yang ingin dihapus terlebih dahulu!');
                return;
            }

            if (confirm(`Yakin ingin menghapus ${checked.length} bukti terpilih?`)) {
                return true;
            }

            return false;
        }

        // Preview selected files
        document.getElementById('bukti_distribusi').addEventListener('change', function(e) {
            const previewArea = document.getElementById('previewArea');
            const previewContainer = document.getElementById('previewContainer');
            const files = e.target.files;

            previewContainer.innerHTML = '';

            if (files.length > 0) {
                previewArea.classList.remove('d-none');

                // Batasi maksimal 5 file
                const maxFiles = 5;
                const filesToShow = Array.from(files).slice(0, maxFiles);

                filesToShow.forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-sm-4 col-6';

                        col.innerHTML = `
                            <div class="preview-item">
                                <img src="${e.target.result}" alt="Preview ${index + 1}">
                                <div class="p-2 text-center bg-light">
                                    <small class="d-block text-truncate">${file.name}</small>
                                    <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                                </div>
                            </div>
                        `;

                        previewContainer.appendChild(col);
                    };

                    reader.readAsDataURL(file);
                });

                // Warning jika lebih dari 5 file
                if (files.length > maxFiles) {
                    const warning = document.createElement('div');
                    warning.className = 'col-12 mt-2';
                    warning.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Hanya ${maxFiles} file pertama yang akan diupload.
                        </div>
                    `;
                    previewContainer.appendChild(warning);
                }
            } else {
                previewArea.classList.add('d-none');
            }
        });

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const logistikId = document.getElementById('logistik_id').value;
            const jumlah = document.getElementById('jumlah').value;

            if (!logistikId || !jumlah || parseInt(jumlah) <= 0) {
                e.preventDefault();
                alert('Mohon pilih logistik dan isi jumlah dengan benar!');
            }
        });

        // Auto-focus first invalid field
        document.addEventListener('DOMContentLoaded', function() {
            const invalidFields = document.querySelectorAll('.is-invalid');
            if (invalidFields.length > 0) {
                invalidFields[0].focus();
            }

            // Inisialisasi info stok
            const logistikSelect = document.getElementById('logistik_id');
            if (logistikSelect.value) {
                const event = new Event('change');
                logistikSelect.dispatchEvent(event);
            }
        });
    </script>
@endpush
