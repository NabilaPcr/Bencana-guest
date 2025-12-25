@extends('layout.guest.app')
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

@endsection
