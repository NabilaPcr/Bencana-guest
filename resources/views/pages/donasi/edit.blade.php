@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('donasi.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Donasi
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Donasi Bencana</h1>
                <p>Edit data donasi untuk kejadian bencana</p>
            </div>

            <form action="{{ route('donasi.update', $donasiBencana->donasi_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kejadian_id">Kejadian Bencana *</label>
                    <select id="kejadian_id" name="kejadian_id" class="form-control" required>
                        <option value="">Pilih Kejadian Bencana</option>
                        @foreach ($kejadianList as $kejadian)
                            <option value="{{ $kejadian->kejadian_id }}"
                                {{ $donasiBencana->kejadian_id == $kejadian->kejadian_id || old('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                                ({{ \Carbon\Carbon::parse($kejadian->tanggal)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('kejadian_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="donatur_nama">Nama Donatur *</label>
                    <input type="text" id="donatur_nama" name="donatur_nama" class="form-control" required
                        placeholder="Masukkan nama donatur"
                        value="{{ old('donatur_nama', $donasiBencana->donatur_nama) }}">
                    @error('donatur_nama')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis">Jenis Donasi *</label>
                            <select id="jenis" name="jenis" class="form-control" required>
                                <option value="">Pilih Jenis Donasi</option>
                                <option value="uang"
                                    {{ $donasiBencana->jenis == 'uang' || old('jenis') == 'uang' ? 'selected' : '' }}>Uang
                                </option>
                                <option value="barang"
                                    {{ $donasiBencana->jenis == 'barang' || old('jenis') == 'barang' ? 'selected' : '' }}>
                                    Barang</option>
                            </select>
                            @error('jenis')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai">Nilai Donasi *</label>
                            <div class="input-group">
                                <input type="number" step="0.01" id="nilai" name="nilai" class="form-control" required
                                    placeholder="Masukkan nilai donasi"
                                    value="{{ old('nilai', $donasiBencana->nilai) }}">
                                <span class="input-group-text" id="unit-label">
                                    {{ $donasiBencana->jenis == 'uang' ? 'Rp' : 'barang' }}
                                </span>
                            </div>
                            @error('nilai')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ✅ BUKTI DONASI YANG SUDAH ADA -->
                @if (isset($files) && $files->count() > 0)
                    <div class="form-group mt-4">
                        <label class="fw-bold mb-3">Bukti Donasi yang sudah diupload</label>
                        <div class="row">
                            @foreach ($files as $file)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="position-relative">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <img src="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                class="img-thumbnail w-100"
                                                style="height: 120px; object-fit: cover;">
                                        @else
                                            <div class="img-thumbnail w-100 d-flex align-items-center justify-content-center"
                                                 style="height: 120px; background: #f8f9fa;">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                            </div>
                                        @endif

                                        <!-- Checkbox kecil di pojok -->
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_media[]"
                                                    value="{{ $file->media_id }}" id="delete_media_{{ $file->media_id }}">
                                                <label class="form-check-label text-danger"
                                                    for="delete_media_{{ $file->media_id }}">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="alert alert-info py-2 mt-2">
                            <i class="fas fa-info-circle me-2"></i>
                            Klik kotak untuk memilih bukti yang akan dihapus
                        </div>
                    </div>
                @endif

                <!-- ✅ UPLOAD BUKTI DONASI BARU -->
                <div class="form-group mt-4">
                    <label class="fw-bold">Upload Bukti Donasi Baru (Opsional)</label>
                    <small class="text-muted d-block mb-2">
                        Format: JPG, PNG, GIF, PDF. Maksimal 2MB per file.
                    </small>

                    <input type="file" name="bukti_donasi[]" class="form-control" accept="image/*,.pdf" multiple>

                    @error('bukti_donasi')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    @error('bukti_donasi.*')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-lightbulb"></i>
                            Kosongkan jika tidak ingin menambah bukti baru.
                        </small>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-save me-2"></i> Update Data Donasi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('jenis');
            const unitLabel = document.getElementById('unit-label');
            const nilaiInput = document.getElementById('nilai');

            // Set initial state berdasarkan data existing
            updateUnitLabel(jenisSelect.value);

            // Change event listener
            jenisSelect.addEventListener('change', function() {
                updateUnitLabel(this.value);
            });

            function updateUnitLabel(jenis) {
                if (jenis === 'uang') {
                    unitLabel.textContent = 'Rp';
                    nilaiInput.placeholder = 'Contoh: 1000000';
                    nilaiInput.step = '0.01';
                } else if (jenis === 'barang') {
                    unitLabel.textContent = 'barang';
                    nilaiInput.placeholder = 'Contoh: 50';
                    nilaiInput.step = '1';
                }
            }
        });
    </script>
@endpush
