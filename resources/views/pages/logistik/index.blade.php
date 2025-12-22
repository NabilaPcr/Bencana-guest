@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-boxes"></i> Logistik Bencana</h1>
            <p>Data barang dan persediaan logistik untuk penanganan bencana</p>
        </div>
        <a href="{{ route('logistik.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Logistik
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <form action="{{ route('logistik.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <!-- Search Input -->
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama barang, sumber...">
                </div>

                <!-- Filter Kejadian -->
                <div class="form-group">
                    <label for="kejadian_id">Kejadian Bencana</label>
                    <select id="kejadian_id" name="kejadian_id">
                        <option value="">Semua Kejadian</option>
                        @foreach($kejadians as $kejadian)
                            <option value="{{ $kejadian->kejadian_id }}"
                                {{ request('kejadian_id') == $kejadian->kejadian_id ? 'selected' : '' }}>
                                {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <a href="{{ route('logistik.index') }}" class="btn-reset">
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

    @if($logistik->count() > 0)
        <div class="warga-grid">
            @foreach($logistik as $item)
            <div class="warga-card">
                <h3><i class="fas fa-box"></i> {{ $item->nama_barang }}</h3>

                <div class="warga-info">
                    <p>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Kejadian:</strong> {{ $item->kejadian->jenis_bencana ?? 'N/A' }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Lokasi:</strong> {{ $item->kejadian->lokasi_text ?? 'N/A' }}
                        @if($item->kejadian)
                            RT {{ $item->kejadian->rt }}/RW {{ $item->kejadian->rw }}
                        @endif
                    </p>
                    <p>
                        <i class="fas fa-weight"></i>
                        <strong>Stok:</strong>
                        <span style="font-size: 1.2rem; font-weight: bold; color: {{ $item->stok > 50 ? '#27ae60' : ($item->stok > 10 ? '#f39c12' : '#e74c3c') }}">
                            {{ $item->stok }}
                        </span>
                        {{ $item->satuan }}
                    </p>
                    <p>
                        <i class="fas fa-tag"></i>
                        <strong>Satuan:</strong> {{ $item->satuan }}
                    </p>
                    <p>
                        <i class="fas fa-source"></i>
                        <strong>Sumber:</strong> {{ $item->sumber ?? '-' }}
                    </p>
                    <p>
                        <i class="fas fa-calendar"></i>
                        <strong>Ditambahkan:</strong> {{ $item->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="card-actions">
                    <a href="{{ route('logistik.show', $item->logistik_id) }}" class="btn-detail">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('logistik.edit', $item->logistik_id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('logistik.destroy', $item->logistik_id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data logistik ini?')">
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
                <p>Menampilkan <strong>{{ $logistik->count() }}</strong> dari <strong>{{ $logistik->total() }}</strong> data logistik</p>
            </div>

            @if($logistik->hasPages())
            <div class="bottom-pagination">
                <div class="pagination-simple">
                    @if(!$logistik->onFirstPage())
                        <a href="{{ $logistik->previousPageUrl() }}" class="btn-prev">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    @endif

                    @if($logistik->hasMorePages())
                        <a href="{{ $logistik->nextPageUrl() }}" class="btn-next">
                            Next <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-boxes"></i>
            <h3>Belum Ada Data Logistik</h3>
            <p>
                @if(request()->has('search') || request()->has('kejadian_id'))
                    Tidak ditemukan data logistik dengan filter yang dipilih.
                    <a href="{{ route('logistik.index') }}">Tampilkan semua data</a>
                @else
                    Silakan tambah data logistik pertama Anda
                @endif
            </p>
        </div>
    @endif
</div>

@endsection
