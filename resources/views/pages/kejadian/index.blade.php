@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="page-header">
            <div class="header-content">
                <div class="header-text">
                    <h1><i class="fas fa-exclamation-triangle"></i> Data Kejadian Bencana</h1>
                    <p>Informasi terbaru tentang kejadian bencana yang sedang ditangani</p>
                </div>
                <a href="{{ route('kejadian.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Kejadian
                </a>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="filter-section">
            <form action="{{ route('kejadian.index') }}" method="GET" class="filter-form">
                <div class="form-row">
                    <!-- Search Input -->
                    <div class="form-group">
                        <label for="search">Pencarian</label>
                        <input type="text" id="search" name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari jenis bencana, lokasi, atau dampak...">
                    </div>

                    <!-- Filter Jenis Bencana -->
                    <div class="form-group">
                        <label for="jenis_bencana">Jenis Bencana</label>
                        <select id="jenis_bencana" name="jenis_bencana">
                            <option value="">Semua Jenis</option>
                            <option value="Banjir" {{ request('jenis_bencana') == 'Banjir' ? 'selected' : '' }}>Banjir</option>
                            <option value="Longsor" {{ request('jenis_bencana') == 'Longsor' ? 'selected' : '' }}>Longsor</option>
                            <option value="Gempa" {{ request('jenis_bencana') == 'Gempa' ? 'selected' : '' }}>Gempa</option>
                            <option value="Kebakaran" {{ request('jenis_bencana') == 'Kebakaran' ? 'selected' : '' }}>Kebakaran</option>
                            <option value="Angin Puting Beliung" {{ request('jenis_bencana') == 'Angin Puting Beliung' ? 'selected' : '' }}>Angin Puting Beliung</option>
                            <option value="Tanah Retak" {{ request('jenis_bencana') == 'Tanah Retak' ? 'selected' : '' }}>Tanah Retak</option>
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div class="form-group">
                        <label for="status_kejadian">Status Kejadian</label>
                        <select id="status_kejadian" name="status_kejadian">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status_kejadian') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="selesai" {{ request('status_kejadian') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dalam penanganan" {{ request('status_kejadian') == 'dalam penanganan' ? 'selected' : '' }}>Dalam Penanganan</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-search"></i> Terapkan
                        </button>
                        <a href="{{ route('kejadian.index') }}" class="btn-reset">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Info hasil pencarian & filter -->
        @if(request()->has('search') && request('search') != '')
        <div class="search-info">
            <p><i class="fas fa-info-circle"></i> Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
        </div>
        @endif

        @if(request()->has('jenis_bencana') && request('jenis_bencana') != '' ||
            request()->has('status_kejadian') && request('status_kejadian') != '')
        <div class="filter-info">
            <p><i class="fas fa-filter"></i> Filter aktif:
                @if(request('jenis_bencana'))
                    <span class="filter-tag">Jenis: {{ request('jenis_bencana') }}</span>
                @endif
                @if(request('status_kejadian'))
                    <span class="filter-tag">Status: {{ ucfirst(request('status_kejadian')) }}</span>
                @endif
            </p>
        </div>
        @endif

        <!-- Header dengan Pagination di Atas -->
        <div class="table-header-with-pagination">
            <div class="data-info">
                <p>Menampilkan <strong>{{ $kejadian->count() }}</strong> dari <strong>{{ $kejadian->total() }}</strong> data kejadian</p>
            </div>

            @if($kejadian->hasPages())
            <div class="top-pagination">
                <div class="pagination-nav">
                    @if(!$kejadian->onFirstPage())
                        <a href="{{ $kejadian->previousPageUrl() }}" class="page-btn prev">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @else
                        <span class="page-btn disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @endif

                    <span class="page-info">Halaman {{ $kejadian->currentPage() }} dari {{ $kejadian->lastPage() }}</span>

                    @if($kejadian->hasMorePages())
                        <a href="{{ $kejadian->nextPageUrl() }}" class="page-btn next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-btn disabled">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        @if($kejadian->count() > 0)
            <div class="kejadian-grid">
                @foreach($kejadian as $item)
                <div class="kejadian-card">
                    <h3><i class="fas fa-bolt"></i> {{ $item->jenis_bencana }}</h3>

                    <div class="kejadian-info">
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Lokasi:</strong> {{ $item->lokasi_text }}
                            @if($item->rt || $item->rw)
                                (RT {{ $item->rt }}/RW {{ $item->rw }})
                            @endif
                        </p>
                        <p>
                            <i class="fas fa-calendar"></i>
                            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </p>
                        <p>
                            <i class="fas fa-fire"></i>
                            <strong>Dampak:</strong> {{ $item->dampak }}
                        </p>
                        <p>
                            <i class="fas fa-info-circle"></i>
                            <strong>Status:</strong>
                            <span class="status-{{ str_replace(' ', '-', $item->status_kejadian) }}">
                                {{ $item->status_kejadian }}
                            </span>
                        </p>
                        @if($item->keterangan)
                        <p>
                            <i class="fas fa-clipboard"></i>
                            <strong>Keterangan:</strong> {{ $item->keterangan }}
                        </p>
                        @endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('kejadian.show', $item->kejadian_id) }}" class="btn-detail">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                        <div class="action-buttons">
                            <a href="{{ route('kejadian.edit', $item->kejadian_id) }}" class="btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kejadian ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>Belum Ada Data Kejadian</h3>
                <p>
                    @if(request()->has('search') || request()->has('jenis_bencana') || request()->has('status_kejadian'))
                        Tidak ditemukan data kejadian dengan filter yang dipilih.
                        <a href="{{ route('kejadian.index') }}">Tampilkan semua data</a>
                    @else
                        Silakan check kembali nanti untuk informasi terbaru
                    @endif
                </p>
            </div>
        @endif
    </div>
    {{-- END MAIN CLASS  --}}

@endsection
