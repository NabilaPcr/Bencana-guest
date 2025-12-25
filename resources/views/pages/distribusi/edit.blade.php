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

            <form action="{{ route('distribusi.update', $distribusi->distribusi_id) }}" method="POST" enctype="multipart/form-data"
                  onsubmit="return validateForm()">
                @csrf
                @method('PUT')

                <!-- Informasi Distribusi -->
                <div class="form-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logistik_id" class="required">Logistik Bencana</label>
                                <select id="logistik_id" name="logistik_id"
                                        class="form-control @error('logistik_id') is-invalid @enderror" required>
                                    <option value="">Pilih Logistik</option>
                                    @foreach($logistik as $logistikItem) <!-- Ubah dari $logistikList ke $logistik -->
                                        <option value="{{ $logistikItem->logistik_id }}"
                                            {{ old('logistik_id', $distribusi->logistik_id) == $logistikItem->logistik_id ? 'selected' : '' }}
                                            data-stok="{{ $logistikItem->stok }}"
                                            data-satuan="{{ $logistikItem->satuan }}">
                                            {{ $logistikItem->nama_barang }} (Stok: {{ $logistikItem->stok }} {{ $logistikItem->satuan }})
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
                                <select id="posko_id" name="posko_id"
                                        class="form-control @error('posko_id') is-invalid @enderror" required>
                                    <option value="">Pilih Posko</option>
                                    @foreach($posko as $poskoItem) <!-- Ubah dari $poskoList ke $posko -->
                                        <option value="{{ $poskoItem->posko_id }}"
                                            {{ old('posko_id', $distribusi->posko_id) == $poskoItem->posko_id ? 'selected' : '' }}>
                                            {{ $poskoItem->nama }} - {{ $poskoItem->kejadian->jenis_bencana ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('posko_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

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
                                <input type="number" id="jumlah" name="jumlah"
                                       class="form-control @error('jumlah') is-invalid @enderror"
                                       value="{{ old('jumlah', $distribusi->jumlah) }}"
                                       placeholder="Contoh: 100" min="1" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted" id="stok-info">Stok tersedia: -</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" id="satuan" name="satuan" readonly
                                       class="form-control bg-light"
                                       placeholder="Satuan otomatis">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penerima & Lokasi -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="penerima" class="required">Penerima</label>
                        <input type="text" id="penerima" name="penerima"
                               class="form-control @error('penerima') is-invalid @enderror"
                               value="{{ old('penerima', $distribusi->penerima) }}"
                               placeholder="Contoh: Bapak Budi Santoso atau Keluarga Wijaya" required>
                        @error('penerima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi Distribusi</label>
                        <input type="text" id="lokasi" name="lokasi"
                               class="form-control @error('lokasi') is-invalid @enderror"
                               value="{{ old('lokasi', $distribusi->lokasi) }}"
                               placeholder="Contoh: Posko Utama, Rumah Korban, dll.">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                                  class="form-control @error('keterangan') is-invalid @enderror"
                                  placeholder="Catatan tambahan tentang distribusi ini">{{ old('keterangan', $distribusi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- DATA BUKTI FOTO YANG SUDAH TERCATAT -->
                {{-- @php
                    $files = $distribusi->getMediaFiles();
                @endphp

                @if($files->count() > 0)
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
                                                            <img src="{{ $distribusi->getImageUrl($file->file_name) }}"
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
                                                @if($distribusi->isPlaceholder($file->file_name))
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-exclamation-triangle me-1"></i> Placeholder
                                                    </span>
                                                @else
                                                    @php
                                                        $path = 'storage/uploads/distribusi_logistik/' . $file->file_name;
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
                @endif --}}

                <!-- UPLOAD BUKTI FOTO BARU -->
                <div class="form-section">
                    <div class="form-group">
                        <label for="bukti_distribusi">Pilih File Bukti Foto</label>
                        <input type="file" name="bukti_distribusi[]" id="bukti_distribusi"
                               class="form-control @error('bukti_distribusi') is-invalid @enderror"
                               accept="image/*" multiple>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Pilih file gambar (JPG, PNG, GIF), Maksimal 2MB per file. Maksimal 5 file.
                        </small>
                        @error('bukti_distribusi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('bukti_distribusi.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Warning jika stok tidak mencukupi -->
                <div class="alert alert-warning d-none" id="stok-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="warning-text"></span>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary" id="submit-btn">
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

    .form-control:focus {
        border-color: #56a65a;
        box-shadow: 0 0 0 0.2rem rgba(86, 166, 90, 0.25);
    }

    .delete-checkbox:checked {
        background-color: #e74c3c;
        border-color: #e74c3c;
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
// Form validation
function validateForm() {
    const logistikId = document.getElementById('logistik_id').value;
    const poskoId = document.getElementById('posko_id').value;
    const tanggal = document.getElementById('tanggal').value;
    const jumlah = document.getElementById('jumlah').value;
    const penerima = document.getElementById('penerima').value.trim();

    if (!logistikId || !poskoId || !tanggal || !jumlah || !penerima) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }

    if (parseInt(jumlah) <= 0) {
        alert('Jumlah harus lebih dari 0!');
        return false;
    }

    // Cek apakah jumlah melebihi stok
    const stokInfo = document.getElementById('stok-info').textContent;
    const stokMatch = stokInfo.match(/Stok tersedia: (\d+)/);
    if (stokMatch) {
        const stokTersedia = parseInt(stokMatch[1]);
        if (parseInt(jumlah) > stokTersedia) {
            alert(`Jumlah (${jumlah}) melebihi stok tersedia (${stokTersedia})!`);
            return false;
        }
    }

    return true;
}

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

        if (jumlah > stok) {
            warningDiv.classList.remove('d-none');
            warningText.textContent = `Jumlah (${jumlah} ${satuan}) melebihi stok tersedia (${stok} ${satuan}).`;
            submitBtn.disabled = true;
        } else {
            warningDiv.classList.add('d-none');
            submitBtn.disabled = false;
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
        alert('Pilih data yang ingin dihapus terlebih dahulu!');
        return;
    }

    if (confirm(`Yakin ingin menghapus ${checked.length} data terpilih?`)) {
        return true;
    }

    return false;
}

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
