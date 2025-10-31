@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('kejadian.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Kejadian
        </a>

        <div class="detail-card">
            <div class="detail-header">
                <h1>
                    <i class="fas fa-bolt"></i>
                    {{ $kejadian->jenis_bencana }}
                    <span class="status-badge status-{{ str_replace(' ', '-', $kejadian->status_kejadian) }}">
                        {{ $kejadian->status_kejadian }}
                    </span>
                </h1>
            </div>

            <div class="detail-grid">
                <div class="info-group">
                    <h3><i class="fas fa-map-marker-alt"></i> Lokasi Kejadian</h3>
                    <div class="info-content">
                        <p><strong>Alamat:</strong> {{ $kejadian->lokasi_text }}</p>
                        @if($kejadian->rt || $kejadian->rw)
                        <p><strong>RT/RW:</strong> {{ $kejadian->rt }}/{{ $kejadian->rw }}</p>
                        @endif
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-calendar"></i> Waktu Kejadian</h3>
                    <div class="info-content">
                        <p><strong>Tanggal:</strong> {{ $kejadian->tanggal->format('d F Y') }}</p>
                        <p><strong>Hari:</strong> {{ $kejadian->tanggal->translatedFormat('l') }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-fire"></i> Dampak</h3>
                    <div class="info-content">
                        <p>{{ $kejadian->dampak }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-info-circle"></i> Status Penanganan</h3>
                    <div class="info-content">
                        <p><strong>Status:</strong> {{ $kejadian->status_kejadian }}</p>
                        <p><strong>Terakhir Update:</strong> {{ $kejadian->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            @if($kejadian->keterangan)
            <div class="info-group">
                <h3><i class="fas fa-clipboard"></i> Keterangan Tambahan</h3>
                <div class="keterangan-box">
                    <p>{{ $kejadian->keterangan }}</p>
                </div>
            </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('kejadian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Lihat Semua Kejadian
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-donate"></i> Donasi Sekarang
                </a>
            </div>
        </div>
    </div>
    {{-- END Content  --}}
@endsection
