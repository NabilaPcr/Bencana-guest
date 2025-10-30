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
                        <p>
                            <i class="fas fa-bolt"></i>
                            <strong>Status:</strong>
                            <span class="status-{{ $item->status_dampak }}">
                                {{ ucfirst($item->status_dampak) }}
                            </span>
                        </p>
                        <p>
                            <i class="fas fa-heartbeat"></i>
                            <strong>Kesehatan:</strong>
                            <span class="health-{{ $item->status_kesehatan }}">
                                {{ ucfirst(str_replace('_', ' ', $item->status_kesehatan)) }}
                            </span>
                        </p>
                        @if($item->kejadian)
                        <p>
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Kejadian:</strong> {{ $item->kejadian->jenis_bencana }}
                        </p>
                        @endif
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
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Data Warga</h3>
                <p>Silakan tambah data warga pertama Anda</p>
            </div>
        @endif
    </div>
    
@endsection
