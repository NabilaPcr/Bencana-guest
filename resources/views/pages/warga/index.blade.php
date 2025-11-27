@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <div class="page-header">
        <div class="header-text">
            <h1><i class="fas fa-users"></i> Data Warga</h1>
            <p>Data warga terdampak bencana, pengungsi, dan relawan</p>
        </div>
        <a href="{{ route('warga.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Warga
        </a>
    </div>

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <form action="{{ route('warga.index') }}" method="GET" class="filter-form">
            <div class="form-row">
                <!-- Search Input -->
                <div class="form-group">
                    <label for="search">Pencarian</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama, NIK, telp, atau alamat...">
                </div>

                <!-- Filter Jenis Kelamin -->
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin">
                        <option value="">Semua</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <a href="{{ route('warga.index') }}" class="btn-reset">
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
    @if(request()->has('jenis_kelamin') && request('jenis_kelamin') != '')
    <div class="filter-info">
        <p><i class="fas fa-filter"></i> Filter aktif:
            <span class="filter-tag">Jenis Kelamin: {{ request('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
        </p>
    </div>
    @endif

    @if($warga->count() > 0)
        <div class="warga-grid">
            @foreach($warga as $item)
            <div class="warga-card">
                <h3><i class="fas fa-user"></i> {{ $item->nama }}</h3>

                <div class="warga-info">
                    <p>
                        <i class="fas fa-id-card"></i>
                        <strong>NIK:</strong> {{ $item->no_ktp }}
                    </p>
                    <p>
                        <i class="fas fa-venus-mars"></i>
                        <strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Alamat:</strong> {{ $item->alamat }} RT{{ $item->rt }}/RW{{ $item->rw }}
                    </p>
                    @if($item->kebutuhan_khusus)
                    <p>
                        <i class="fas fa-info-circle"></i>
                        <strong>Kebutuhan:</strong> {{ $item->kebutuhan_khusus }}
                    </p>
                    @endif
                </div>

                <div class="card-actions">
                    <a href="{{ route('warga.show', $item->warga_id) }}" class="btn-detail">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
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
                <p>Menampilkan <strong>{{ $warga->count() }}</strong> dari <strong>{{ $warga->total() }}</strong> data warga</p>
            </div>

            @if($warga->hasPages())
            <div class="bottom-pagination">
                <div class="pagination-simple">
                    @if(!$warga->onFirstPage())
                        <a href="{{ $warga->previousPageUrl() }}" class="btn-prev">
                            <i class="fas fa-arrow-left"></i> Previous
                        </a>
                    @endif

                    @if($warga->hasMorePages())
                        <a href="{{ $warga->nextPageUrl() }}" class="btn-next">
                            Next <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <h3>Belum Ada Data Warga</h3>
            <p>
                @if(request()->has('search') || request()->has('jenis_kelamin'))
                    Tidak ditemukan data warga dengan filter yang dipilih.
                    <a href="{{ route('warga.index') }}">Tampilkan semua data</a>
                @else
                    Silakan tambah data warga pertama Anda
                @endif
            </p>
        </div>
    @endif
</div>

@endsection
