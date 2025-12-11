@extends('layout.guest.app')
@section('title', 'Detail Donasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-eye"></i> Detail Donasi</h4>
                    <div>
                        <a href="{{ route('donasi.edit', $donasiBencana->donasi_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informasi Donatur</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Nama Donatur</th>
                                            <td>{{ $donasiBencana->donatur_nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Donasi</th>
                                            <td>
                                                <span class="badge bg-{{ $donasiBencana->jenis == 'uang' ? 'success' : 'info' }}">
                                                    {{ ucfirst($donasiBencana->jenis) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nilai Donasi</th>
                                            <td>
                                                @if ($donasiBencana->jenis == 'uang')
                                                    <strong class="text-success">Rp {{ number_format($donasiBencana->nilai, 0, ',', '.') }}</strong>
                                                @else
                                                    <strong class="text-info">{{ number_format($donasiBencana->nilai, 0) }} barang</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Donasi</th>
                                            <td>{{ $donasiBencana->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informasi Kejadian Bencana</h5>
                                </div>
                                <div class="card-body">
                                    @if($donasiBencana->kejadian)
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Jenis Bencana</th>
                                            <td>{{ $donasiBencana->kejadian->jenis_bencana }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $donasiBencana->kejadian->lokasi_text }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Kejadian</th>
                                            <td>{{ \Carbon\Carbon::parse($donasiBencana->kejadian->tanggal)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @php
                                                    $statusClass = [
                                                        'aktif' => 'danger',
                                                        'selesai' => 'success',
                                                        'dalam penanganan' => 'warning'
                                                    ][$donasiBencana->kejadian->status_kejadian] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }}">
                                                    {{ ucfirst($donasiBencana->kejadian->status_kejadian) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                    @else
                                    <p class="text-muted">Data kejadian tidak ditemukan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('donasi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <a href="{{ route('donasi.edit', $donasiBencana->donasi_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        <form action="{{ route('donasi.destroy', $donasiBencana->donasi_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
