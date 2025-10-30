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
                            <strong>Tanggal:</strong> {{ $item->tanggal->format('d M Y') }}
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
                <p>Silakan check kembali nanti untuk informasi terbaru</p>
            </div>
        @endif
    </div>
    {{-- END MAIN CLASS  --}}
@endsection
