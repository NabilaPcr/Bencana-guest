@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-truck-loading"></i> Data Distribusi Logistik</h1>
            <p>Data penyaluran logistik bantuan ke posko bencana</p>
        </div>
        <a href="{{ route('distribusi.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Distribusi
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <form action="{{ route('distribusi.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <!-- Search Input -->
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari penerima, lokasi, atau nama barang...">
                </div>

                <!-- Filter Tanggal -->
                <div class="form-group">
                    <label for="tanggal_dari">Tanggal Dari</label>
                    <input type="date" id="tanggal_dari" name="tanggal_dari"
                           value="{{ request('tanggal_dari') }}">
                </div>

                <div class="form-group">
                    <label for="tanggal_sampai">Tanggal Sampai</label>
                    <input type="date" id="tanggal_sampai" name="tanggal_sampai"
                           value="{{ request('tanggal_sampai') }}">
                </div>

                <!-- Action Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <a href="{{ route('distribusi.index') }}" class="btn-reset">
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
    @if((request()->has('tanggal_dari') && request('tanggal_dari') != '') ||
        (request()->has('tanggal_sampai') && request('tanggal_sampai') != ''))
    <div class="filter-info">
        <p><i class="fas fa-filter"></i> Filter aktif:
            @if(request('tanggal_dari'))
            <span class="filter-tag">Dari: {{ request('tanggal_dari') }}</span>
            @endif
            @if(request('tanggal_sampai'))
            <span class="filter-tag">Sampai: {{ request('tanggal_sampai') }}</span>
            @endif
        </p>
    </div>
    @endif

    @if($distribusi->count() > 0)
        <div class="warga-grid">
            @foreach($distribusi as $dist)
            <div class="warga-card">
                <h3>
                    <i class="fas fa-box"></i> {{ $dist->logistik->nama_barang ?? 'Logistik Tidak Ditemukan' }}
                </h3>

                <div class="warga-info">
                    <p>
                        <i class="fas fa-id-card"></i>
                        <strong>ID Distribusi:</strong> {{ $dist->distribusi_id }}
                    </p>
                    <p>
                        <i class="fas fa-calendar"></i>
                        <strong>Tanggal:</strong> {{ $dist->tanggal->format('d F Y') }}
                    </p>
                    <p>
                        <i class="fas fa-user"></i>
                        <strong>Penerima:</strong> {{ $dist->penerima }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Lokasi:</strong> {{ $dist->lokasi ?? '-' }}
                    </p>
                    <p>
                        <i class="fas fa-calculator"></i>
                        <strong>Jumlah:</strong> {{ $dist->jumlah }} {{ $dist->logistik->satuan ?? '' }}
                    </p>
                    <p>
                        <i class="fas fa-first-aid"></i>
                        <strong>Posko:</strong> {{ $dist->posko->nama ?? 'Posko Tidak Ditemukan' }}
                    </p>
                    <p>
                        <i class="fas fa-sticky-note"></i>
                        <strong>Keterangan:</strong> {{ Str::limit($dist->keterangan ?? '-', 50) }}
                    </p>

                    <!-- Bukti Distribusi -->
                    @if($dist->hasRealBukti)
                    <p>
                        <i class="fas fa-images"></i>
                        <strong>Bukti:</strong> <span class="text-success">Tersedia</span>
                    </p>
                    @endif
                </div>

                <div class="card-actions">
                    <a href="{{ route('distribusi.show', $dist->distribusi_id) }}" class="btn-detail">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('distribusi.edit', $dist->distribusi_id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('distribusi.destroy', $dist->distribusi_id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data distribusi ini?')">
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
                <p>Menampilkan <strong>{{ $distribusi->count() }}</strong> dari <strong>{{ $distribusi->total() }}</strong> data distribusi</p>
            </div>

            @if($distribusi->hasPages())
            <div class="bottom-pagination">
                <div class="pagination-simple">
                    @if(!$distribusi->onFirstPage())
                        <a href="{{ $distribusi->previousPageUrl() }}" class="btn-prev">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    @endif

                    @if($distribusi->hasMorePages())
                        <a href="{{ $distribusi->nextPageUrl() }}" class="btn-next">
                            Next <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-truck"></i>
            <h3>Belum Ada Data Distribusi</h3>
            <p>
                @if(request()->has('search') || request()->has('tanggal_dari') || request()->has('tanggal_sampai'))
                    Tidak ditemukan data distribusi dengan filter yang dipilih.
                    <a href="{{ route('distribusi.index') }}">Tampilkan semua data</a>
                @else
                    Silakan tambah data distribusi pertama Anda
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
