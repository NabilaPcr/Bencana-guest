@extends('layout.guest.app')
@section('title', 'Data Donasi Bencana')

@section('content')
{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Donasi Bencana</h4>
                    <a href="{{ route('donasi.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Donasi
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Donatur</th>
                                    <th>Kejadian Bencana</th>
                                    <th>Jenis</th>
                                    <th>Nilai</th>
                                    <th>Tanggal</th>
                                    <th style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($donasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($donasi->currentPage() - 1) * $donasi->perPage() }}</td>
                                        <td><strong>{{ $item->donatur_nama }}</strong></td>
                                        <td>
                                            <strong>{{ $item->kejadian->jenis_bencana ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $item->kejadian->lokasi_text ?? '' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->jenis == 'uang' ? 'success' : 'info' }}">
                                                {{ ucfirst($item->jenis) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->jenis == 'uang')
                                                <strong class="text-success">Rp {{ number_format($item->nilai, 0, ',', '.') }}</strong>
                                            @else
                                                <strong class="text-info">{{ number_format($item->nilai, 0) }} barang</strong>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('donasi.show', $item->donasi_id) }}"
                                                    class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('donasi.edit', $item->donasi_id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('donasi.destroy', $item->donasi_id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus donasi dari {{ $item->donatur_nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-box-open fa-2x mb-3"></i>
                                                <h5>Belum ada data donasi</h5>
                                                <p>Mulai dengan menambahkan data donasi baru</p>
                                                <a href="{{ route('donasi.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Donasi Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($donasi->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $donasi->firstItem() }} - {{ $donasi->lastItem() }} dari {{ $donasi->total() }} data
                        </div>
                        <div>
                            {{ $donasi->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                      Data Donasi Bencana
                    </h4>
                    <a href="{{ route('donasi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Donasi
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th>Donatur</th>
                                    <th>Kejadian Bencana</th>
                                    <th width="100">Jenis</th>
                                    <th width="150">Jumlah</th>
                                    <th width="120">Tanggal</th>
                                    <th width="180" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($donasi as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration + ($donasi->currentPage() - 1) * $donasi->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                                                    <i class="fas fa-user text-primary fs-6"></i>
                                                </div>
                                                <div>
                                                    <strong class="d-block">{{ $item->donatur_nama }}</strong>
                                                    <small class="text-muted">{{ $item->donatur_telepon ?? '-' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong class="d-block">{{ $item->kejadian->jenis_bencana ?? '-' }}</strong>
                                            <small class="text-muted text-truncate d-block" style="max-width: 200px;">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $item->kejadian->lokasi_text ?? 'Lokasi tidak tersedia' }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->jenis == 'uang' ? 'success' : 'info' }} p-2 w-100">
                                                <i class="fas fa-{{ $item->jenis == 'uang' ? 'money-bill-wave' : 'box' }} me-1"></i>
                                                {{ ucfirst($item->jenis) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->jenis == 'uang')
                                                <div class="text-success fw-bold">
                                                    <i class="fas fa-money-bill-wave me-1"></i>
                                                    Rp {{ number_format($item->nilai, 0, ',', '.') }}
                                                </div>
                                            @else
                                                <div class="text-info fw-bold">
                                                    <i class="fas fa-boxes me-1"></i>
                                                    {{ number_format($item->nilai, 0) }} barang
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $item->created_at->format('d/m/Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('donasi.show', $item->donasi_id) }}"
                                                    class="btn btn-info btn-sm px-3"
                                                    title="Detail" data-bs-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('donasi.edit', $item->donasi_id) }}"
                                                    class="btn btn-warning btn-sm px-3"
                                                    title="Edit" data-bs-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('donasi.destroy', $item->donasi_id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus donasi dari {{ $item->donatur_nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm px-3"
                                                        title="Hapus" data-bs-toggle="tooltip">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-state-icon mb-3">
                                                    <i class="fas fa-hand-holding-heart fa-3x text-muted"></i>
                                                </div>
                                                <h5 class="text-muted mb-2">Belum ada data donasi</h5>
                                                <p class="text-muted mb-4">Mulai dengan menambahkan data donasi baru</p>
                                                <a href="{{ route('donasi.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i> Tambah Donasi Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($donasi->hasPages())
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="mb-3 mb-md-0">
                                <p class="text-muted mb-0">
                                    Menampilkan
                                    <span class="fw-bold">{{ $donasi->firstItem() }}</span>
                                    sampai
                                    <span class="fw-bold">{{ $donasi->lastItem() }}</span>
                                    dari
                                    <span class="fw-bold">{{ $donasi->total() }}</span>
                                    data donasi
                                </p>
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($donasi->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $donasi->previousPageUrl() }}" aria-label="Previous">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @php
                                        $current = $donasi->currentPage();
                                        $last = $donasi->lastPage();
                                        $start = max($current - 2, 1);
                                        $end = min($current + 2, $last);
                                    @endphp

                                    {{-- First Page Link --}}
                                    @if ($start > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $donasi->url(1) }}">1</a>
                                        </li>
                                        @if ($start > 2)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                    @endif

                                    {{-- Page Number Links --}}
                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $current)
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $i }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $donasi->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Last Page Link --}}
                                    @if ($end < $last)
                                        @if ($end < $last - 1)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $donasi->url($last) }}">{{ $last }}</a>
                                        </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($donasi->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $donasi->nextPageUrl() }}" aria-label="Next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="fas fa-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        font-weight: 600;
        color: #495057;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table > tbody > tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .avatar-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge {
        font-size: 0.8em;
        font-weight: 500;
    }

    .empty-state {
        padding: 3rem 1rem;
    }

    .empty-state-icon {
        opacity: 0.5;
    }

    .page-link {
        color: #495057;
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        color: #0d6efd;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush

