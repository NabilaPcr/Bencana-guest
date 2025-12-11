@extends('layout.guest.app')
@section('title', 'Data Donasi Bencana')

@section('content')
<div class="container-fluid">
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
                                    <th>#</th>
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
</div>
@endsection
