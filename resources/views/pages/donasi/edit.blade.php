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

            <form action="{{ route('donasi.update', $donasiBencana->donasi_id) }}" method="POST">
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

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-save"></i> Update Data Donasi
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
