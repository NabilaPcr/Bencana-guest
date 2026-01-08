{{-- @extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-first-aid"></i> Data Posko</h1>
            <p>Data posko bantuan dan lokasi penanggung jawab</p>
        </div>
        <a href="{{ route('posko.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Posko
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <form action="{{ route('posko.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <!-- Search Input -->
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama posko, penanggung jawab, atau lokasi...">
                </div>

                <!-- Filter Jenis Bencana -->
                <div class="form-group">
                    <label for="jenis_bencana">Jenis Bencana</label>
                    <select id="jenis_bencana" name="jenis_bencana">
                        <option value="">Semua Bencana</option>
                        @foreach($jenisBencanaList as $jenisBencana)
                            <option value="{{ $jenisBencana }}"
                                {{ request('jenis_bencana') == $jenisBencana ? 'selected' : '' }}>
                                {{ $jenisBencana }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <a href="{{ route('posko.index') }}" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Info hasil pencarian -->
    @if(request()->has('search') && request('search') != '')
    <div class="search-info">
        <p><i class="fas fa-info-circle"></i> Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
    </div>
    @endif

    <!-- Info filter aktif -->
    @if(request()->has('jenis_bencana') && request('jenis_bencana') != '')
    <div class="filter-info">
        <p><i class="fas fa-filter"></i> Filter aktif:
            <span class="filter-tag">Jenis Bencana: {{ request('jenis_bencana') }}</span>
        </p>
    </div>
    @endif

    @if($poskoBencana->count() > 0)
        <div class="warga-grid">
            @foreach($poskoBencana as $posko)
            <div class="warga-card">
                <h3><i class="fas fa-first-aid"></i> {{ $posko->nama }}</h3>

                <div class="warga-info">1
                    <p>
                        <i class="fas fa-user"></i>
                        <strong>Penanggung Jawab:</strong> {{ $posko->penanggung_jawab }}
                    </p>
                    <p>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Jenis Bencana:</strong> {{ $posko->kejadian->jenis_bencana ?? 'N/A' }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Lokasi Kejadian:</strong> {{ $posko->kejadian->lokasi_text ?? 'N/A' }}
                        @if($posko->kejadian)
                            RT {{ $posko->kejadian->rt }}/RW {{ $posko->kejadian->rw }}
                        @endif
                    </p>
                    <p>
                        <i class="fas fa-home"></i>
                        <strong>Alamat Posko:</strong> {{ $posko->alamat }}
                    </p>
                    <p>
                        <i class="fas fa-phone"></i>
                        <strong>Kontak:</strong> {{ $posko->kontak }}
                    </p>
                </div>

                <div class="card-actions">
                    <a href="{{ route('posko.show', $posko->posko_id) }}" class="btn-detail">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('posko.edit', $posko->posko_id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('posko.destroy', $posko->posko_id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data posko ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- INFO DATA DAN PAGINATION DI BAWAH -->
        <div class="table-header-with-pagination" style="margin-top: 30px;">
            <div class="data-info">
                <p>Menampilkan <strong>{{ $poskoBencana->count() }}</strong> dari <strong>{{ $poskoBencana->total() }}</strong> data posko</p>
            </div>

            @if($poskoBencana->hasPages())
            <div class="bottom-pagination">
                <div class="pagination-simple">
                    @if(!$poskoBencana->onFirstPage())
                        <a href="{{ $poskoBencana->previousPageUrl() }}" class="btn-prev">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    @endif

                    @if($poskoBencana->hasMorePages())
                        <a href="{{ $poskoBencana->nextPageUrl() }}" class="btn-next">
                            Next <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-first-aid"></i>
            <h3>Belum Ada Data Posko</h3>
            <p>
                @if(request()->has('search') || request()->has('jenis_bencana'))
                    Tidak ditemukan data posko dengan filter yang dipilih.
                    <a href="{{ route('posko.index') }}">Tampilkan semua data</a>
                @else
                    Silakan tambah data posko pertama Anda
                @endif
            </p>
        </div>
    @endif
</div>

@endsection --}}


@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-first-aid"></i> Data Posko Penanganan Bencana</h1>
            <p>Kelola posko bantuan berdasarkan kejadian bencana</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <form action="{{ route('posko.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <!-- Search Input -->
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama bencana, lokasi, atau penanggung jawab...">
                </div>

                <!-- Filter Jenis Bencana -->
                <div class="form-group">
                    <label for="jenis_bencana">Jenis Bencana</label>
                    <select id="jenis_bencana" name="jenis_bencana">
                        <option value="">Semua Bencana</option>
                        @foreach($jenisBencanaList as $jenisBencana)
                            <option value="{{ $jenisBencana }}"
                                {{ request('jenis_bencana') == $jenisBencana ? 'selected' : '' }}>
                                {{ $jenisBencana }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <a href="{{ route('posko.index') }}" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    @if($kejadianList->count() > 0)
        <div class="kejadian-list-container">
            @foreach($kejadianList as $kejadian)
            <div class="bencana-card">
                <div class="bencana-card-inner">
                    <!-- Kolom 1: Gambar (jika ada) -->
                    <div class="bencana-image">
                        @php
                            // Ambil gambar pertama dari media kejadian atau posko
                            $image = null;
                            if($kejadian->media->count() > 0) {
                                $image = $kejadian->media->first()->file_name;
                            } else {
                                // Coba ambil dari posko pertama jika ada
                                $firstPosko = $kejadian->posko->first();
                                if($firstPosko && $firstPosko->media->count() > 0) {
                                    $image = $firstPosko->media->first()->file_name;
                                }
                            }
                        @endphp

                        @if($image)
                            <img src="{{ asset('storage/uploads/' . (str_contains($image, 'posko') ? 'posko_bencana' : 'kejadian_bencana') . '/' . $image) }}"
                                 alt="{{ $kejadian->jenis_bencana }}" class="bencana-img">
                        @else
                            <div class="bencana-img-placeholder">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Kolom 2: Info Bencana -->
                    <div class="bencana-info">
                        <h3>
                            <a href="{{ route('kejadian.show', $kejadian->kejadian_id) }}" class="bencana-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $kejadian->jenis_bencana }}
                            </a>
                        </h3>
                        <div class="bencana-details">
                            <p><i class="fas fa-map-marker-alt"></i> <strong>Lokasi:</strong> {{ $kejadian->lokasi_text }}</p>
                            <p><i class="fas fa-calendar"></i> <strong>Tanggal:</strong> {{ date('d M Y', strtotime($kejadian->tanggal_kejadian)) }}</p>
                            <p><i class="fas fa-clock"></i> <strong>Waktu:</strong> {{ date('H:i', strtotime($kejadian->waktu_kejadian)) }}</p>
                            <p><i class="fas fa-info-circle"></i> <strong>Status:</strong>
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $kejadian->status)) }}">
                                    {{ $kejadian->status }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Kolom 3: Jumlah Posko & Aksi -->
                    <div class="bencana-actions">
                        <div class="posko-count-section">
                            <div class="posko-count">
                                <span class="count-number">{{ $kejadian->posko_count }}</span>
                                <span class="count-label">Posko Aktif</span>
                            </div>
                            <button class="btn-show-posko" data-kejadian-id="{{ $kejadian->kejadian_id }}">
                                <i class="fas fa-list"></i> Lihat Detail
                            </button>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('posko.create') }}?kejadian_id={{ $kejadian->kejadian_id }}"
                               class="btn-add-posko">
                                <i class="fas fa-plus"></i> Tambah Posko
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Detail Posko (hidden by default) -->
                <div class="posko-detail-section" id="posko-detail-{{ $kejadian->kejadian_id }}" style="display: none;">
                    <div class="posko-detail-header">
                        <h4><i class="fas fa-first-aid"></i> Daftar Posko</h4>
                    </div>

                    @if($kejadian->posko->count() > 0)
                    <div class="posko-list">
                        @foreach($kejadian->posko as $posko)
                        <div class="posko-item">
                            <div class="posko-info">
                                <h5>{{ $posko->nama }}</h5>
                                <p><i class="fas fa-user"></i> <strong>Penanggung Jawab:</strong> {{ $posko->penanggung_jawab }}</p>
                                <p><i class="fas fa-map-marker-alt"></i> <strong>Lokasi Posko:</strong> {{ $posko->alamat }}</p>
                                <p><i class="fas fa-phone"></i> <strong>Kontak:</strong> {{ $posko->kontak }}</p>
                            </div>
                            <div class="posko-item-actions">
                                <a href="{{ route('posko.show', $posko->posko_id) }}" class="btn-detail-small">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('posko.edit', $posko->posko_id) }}" class="btn-edit-small">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-posko">
                        <p><i class="fas fa-info-circle"></i> Belum ada posko untuk bencana ini.</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($kejadianList->hasPages())
        <div class="bottom-pagination">
            <div class="pagination-simple">
                @if(!$kejadianList->onFirstPage())
                    <a href="{{ $kejadianList->previousPageUrl() }}" class="btn-prev">
                        <i class="fas fa-arrow-left"></i> Previous
                    </a>
                @endif

                @if($kejadianList->hasMorePages())
                    <a href="{{ $kejadianList->nextPageUrl() }}" class="btn-next">
                        Next <i class="fas fa-arrow-right"></i>
                    </a>
                @endif
            </div>

            <div class="data-info">
                <p>Menampilkan <strong>{{ $kejadianList->count() }}</strong> dari <strong>{{ $kejadianList->total() }}</strong> bencana</p>
            </div>
        </div>
        @endif

    @else
        <div class="empty-state">
            <i class="fas fa-first-aid"></i>
            <h3>Belum Ada Data Bencana dengan Posko</h3>
            <p>
                @if(request()->has('search') || request()->has('jenis_bencana'))
                    Tidak ditemukan data bencana dengan filter yang dipilih.
                    <a href="{{ route('posko.index') }}">Tampilkan semua data</a>
                @else
                    Belum ada data bencana yang memiliki posko.
                @endif
            </p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle detail posko
    document.querySelectorAll('.btn-show-posko').forEach(button => {
        button.addEventListener('click', function() {
            const kejadianId = this.getAttribute('data-kejadian-id');
            const detailSection = document.getElementById('posko-detail-' + kejadianId);

            if (detailSection.style.display === 'none') {
                detailSection.style.display = 'block';
                this.innerHTML = '<i class="fas fa-chevron-up"></i> Sembunyikan';
            } else {
                detailSection.style.display = 'none';
                this.innerHTML = '<i class="fas fa-list"></i> Lihat Detail';
            }
        });
    });
});
</script>
@endpush
