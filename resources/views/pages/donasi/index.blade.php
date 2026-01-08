@extends('layout.guest.app')
@section('title', 'Data Donasi Bencana')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="page-header">
            <div class="header-text">
                <h1><i class="fas fa-hand-holding-heart"></i> Data Donasi Bencana</h1>
                <p>Kelola donasi berdasarkan kejadian bencana</p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="filter-section">
            <form action="{{ route('donasi.index') }}" method="GET" class="filter-form">
                <div class="form-row">
                    <!-- Search Input -->
                    <div class="form-group">
                        <label for="search">Pencarian</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama bencana, lokasi, atau donatur...">
                    </div>

                    <!-- Filter Jenis Bencana -->
                    <div class="form-group">
                        <label for="jenis_bencana">Jenis Bencana</label>
                        <select id="jenis_bencana" name="jenis_bencana">
                            <option value="">Semua Bencana</option>
                            @foreach ($jenisBencanaList as $jenisBencana)
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
                        <a href="{{ route('donasi.index') }}" class="btn-reset">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Info hasil pencarian -->
        @if (request()->has('search') && request('search') != '')
            <div class="search-info">
                <p><i class="fas fa-info-circle"></i> Menampilkan hasil pencarian untuk:
                    <strong>"{{ request('search') }}"</strong>
                </p>
            </div>
        @endif

        <!-- Info filter aktif -->
        @if (request()->has('jenis_bencana') && request('jenis_bencana') != '')
            <div class="filter-info">
                <p><i class="fas fa-filter"></i> Filter aktif:
                    <span class="filter-tag">Jenis Bencana: {{ request('jenis_bencana') }}</span>
                </p>
            </div>
        @endif

        @if ($kejadianList->count() > 0)
            <div class="kejadian-list-container">
                @foreach ($kejadianList as $kejadian)
                    <div class="bencana-card">
                        <div class="bencana-card-inner">
                            <!-- Kolom 1: Gambar -->
                            <div class="bencana-image">
                                @php
                                    // Ambil gambar pertama dari media kejadian
                                    $image = null;
                                    if ($kejadian->media->count() > 0) {
                                        $image = $kejadian->media->first()->file_name;
                                    }
                                @endphp

                                @if ($image)
                                    <img src="{{ asset('storage/uploads/kejadian_bencana/' . $image) }}"
                                        alt="{{ $kejadian->jenis_bencana }}" class="bencana-img">
                                @else
                                    <div class="bencana-img-placeholder">
                                        <i class="fas fa-hand-holding-heart"></i>
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
                                    <p><i class="fas fa-map-marker-alt"></i> <strong>Lokasi:</strong>
                                        {{ $kejadian->lokasi_text }}</p>
                                    <p><i class="fas fa-calendar"></i> <strong>Tanggal:</strong>
                                        {{ date('d M Y', strtotime($kejadian->tanggal)) }}</p>
                                    <p><i class="fas fa-users"></i> <strong>Total Donatur:</strong>
                                        {{ $kejadian->donasi_count }}</p>
                                    <p><i class="fas fa-info-circle"></i> <strong>Status:</strong>
                                        <span
                                            class="status-badge status-{{ strtolower(str_replace(' ', '-', $kejadian->status_kejadian)) }}">
                                            {{ ucfirst($kejadian->status_kejadian) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- Kolom 3: Statistik Donasi & Aksi -->
                            <div class="bencana-actions">
                                <div class="donasi-count-section">
                                    <div class="donasi-count">
                                        <span class="count-number">{{ $kejadian->donasi_count }}</span>
                                        <span class="count-label">Total Donasi</span>
                                    </div>
                                    <div class="donasi-stats">
                                        <div class="stat-item uang">
                                            <span class="stat-number">Rp
                                                {{ number_format($kejadian->total_donasi_uang, 0, ',', '.') }}</span>
                                            <span class="stat-label">Donasi Uang</span>
                                        </div>
                                        <div class="stat-item barang">
                                            <span
                                                class="stat-number">{{ number_format($kejadian->total_donasi_barang, 0) }}</span>
                                            <span class="stat-label">Donasi Barang</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('donasi.show', $kejadian->kejadian_id) }}" class="btn-show-donasi">
                                        <i class="fas fa-list"></i> Lihat Detail
                                    </a>

                                    <div class="action-buttons">
                                        <a href="{{ route('donasi.create') }}?kejadian_id={{ $kejadian->kejadian_id }}"
                                            class="btn-add-donasi">
                                            <i class="fas fa-plus"></i> Tambah Donasi
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Donasi (hidden by default) -->
                            <div class="donasi-detail-section" id="donasi-detail-{{ $kejadian->kejadian_id }}"
                                style="display: none;">
                                <div class="donasi-detail-header">
                                    <h4><i class="fas fa-hand-holding-heart"></i> Daftar Donasi</h4>
                                </div>

                                @if ($kejadian->donasi->count() > 0)
                                    <div class="donasi-list">
                                        @foreach ($kejadian->donasi as $donasi)
                                            <div class="donasi-item">
                                                <div class="donasi-info">
                                                    <h5>{{ $donasi->donatur_nama }}</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><i class="fas fa-gift"></i> <strong>Jenis:</strong>
                                                                <span
                                                                    class="badge bg-{{ $donasi->jenis == 'uang' ? 'success' : 'info' }}">
                                                                    {{ ucfirst($donasi->jenis) }}
                                                                </span>
                                                            </p>
                                                            <p><i class="fas fa-money-bill-wave"></i>
                                                                <strong>Nilai:</strong>
                                                                @if ($donasi->jenis == 'uang')
                                                                    Rp {{ number_format($donasi->nilai, 0, ',', '.') }}
                                                                @else
                                                                    {{ number_format($donasi->nilai, 0) }} barang
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p><i class="fas fa-calendar"></i> <strong>Tanggal:</strong>
                                                                {{ $donasi->created_at->format('d M Y') }}</p>
                                                            <p><i class="fas fa-phone"></i> <strong>Kontak:</strong>
                                                                {{ $donasi->donatur_telepon ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="donasi-item-actions">
                                                    <a href="{{ route('donasi.show', $donasi->donasi_id) }}"
                                                        class="btn-detail-small">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('donasi.edit', $donasi->donasi_id) }}"
                                                        class="btn-edit-small">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-donasi">
                                        <p><i class="fas fa-info-circle"></i> Belum ada donasi untuk bencana ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($kejadianList->hasPages())
                <div class="bottom-pagination">
                    <div class="pagination-simple">
                        @if (!$kejadianList->onFirstPage())
                            <a href="{{ $kejadianList->previousPageUrl() }}" class="btn-prev">
                                <i class="fas fa-arrow-left"></i> Previous
                            </a>
                        @endif

                        @if ($kejadianList->hasMorePages())
                            <a href="{{ $kejadianList->nextPageUrl() }}" class="btn-next">
                                Next <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>

                    <div class="data-info">
                        <p>Menampilkan <strong>{{ $kejadianList->count() }}</strong> dari
                            <strong>{{ $kejadianList->total() }}</strong> bencana
                        </p>
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-hand-holding-heart"></i>
                <h3>Belum Ada Data Bencana dengan Donasi</h3>
                <p>
                    @if (request()->has('search') || request()->has('jenis_bencana'))
                        Tidak ditemukan data bencana dengan filter yang dipilih.
                        <a href="{{ route('donasi.index') }}">Tampilkan semua data</a>
                    @else
                        Belum ada data bencana yang memiliki donasi.
                    @endif
                </p>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        /* ===== DONASI CARD STYLES ===== */
        .donasi-stats-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            width: 100%;
        }

        .donasi-stat {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            width: 100%;
        }

        .stat-item {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(86, 166, 90, 0.2);
        }

        .stat-number {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 0.75rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .btn-show-donasi {
            background: var(--info);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s;
            font-size: 0.85rem;
            width: 100%;
            height: 36px;
            min-height: 36px;
        }

        .btn-show-donasi:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
        }

        .btn-add-donasi {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 9px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s;
            width: 100%;
            height: 36px;
            min-height: 36px;
            font-size: 0.85rem;
        }

        .btn-add-donasi:hover {
            background: linear-gradient(135deg, #229954, #27ae60);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
        }

        /* Detail Donasi Section */
        .donasi-detail-section {
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 20px 25px;
        }

        .donasi-detail-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
        }

        .donasi-detail-header h4 {
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        .donasi-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .donasi-item {
            background: white;
            border-radius: 10px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .donasi-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .donasi-info {
            flex: 1;
        }

        .donasi-info h5 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1rem;
            font-weight: 600;
        }

        .donasi-info p {
            margin: 3px 0;
            color: #555;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            line-height: 1.4;
        }

        .donasi-info .badge {
            font-size: 0.75rem;
            padding: 3px 8px;
        }

        .empty-donasi {
            text-align: center;
            padding: 20px;
            color: #666;
            background: #f9f9f9;
            border-radius: 8px;
            border: 1px dashed #ddd;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .donasi-stat {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .stat-item {
                padding: 10px;
            }

            .stat-number {
                font-size: 0.9rem;
            }

            .donasi-item {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .donasi-item-actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .stat-number {
                font-size: 0.85rem;
            }

            .stat-label {
                font-size: 0.7rem;
            }

            .donasi-info .row {
                flex-direction: column;
            }
        }

        /* ===== DONASI SPECIFIC STYLES ===== */
        .bencana-img-placeholder .fa-hand-holding-heart {
            color: #27ae60;
        }

        /* Status badges khusus donasi */
        .status-aktif {
            background: #ffeaea;
            color: var(--danger);
        }

        .status-dalam-penanganan {
            background: #fef5e7;
            color: var(--warning);
        }

        .status-selesai {
            background: #eafaf1;
            color: #27ae60;
        }

        /* Tombol khusus donasi */
        .btn-add-donasi {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
        }

        .btn-add-donasi:hover {
            background: linear-gradient(135deg, #229954, #27ae60);
        }

        /* Badge untuk jenis donasi */
        .badge-donasi-uang {
            background: #27ae60;
            color: white;
        }

        .badge-donasi-barang {
            background: #3498db;
            color: white;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-show-donasi').forEach(button => {
                button.addEventListener('click', function() {
                    const kejadianId = this.getAttribute('data-kejadian-id');
                    const detailSection = document.getElementById('donasi-detail-' + kejadianId);

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
