@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('posko.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Posko
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>
                <i class="fas fa-house-user"></i>
                {{ $posko->nama_posko }}

                <span class="status-badge status-{{ str_replace(' ', '-', strtolower($posko->status_posko)) }}">
                    {{ $posko->status_posko }}
                </span>
            </h1>
        </div>

        <div class="detail-grid">
            <!-- LOKASI POSKO -->
            <div class="info-group">
                <h3><i class="fas fa-map-marker-alt"></i> Lokasi Posko</h3>
                <div class="info-content">
                    <p><strong>Alamat:</strong> {{ $posko->alamat }}</p>
                    @if($posko->rt || $posko->rw)
                    <p><strong>RT/RW:</strong> {{ $posko->rt }}/{{ $posko->rw }}</p>
                    @endif
                    @if($posko->kelurahan)
                    <p><strong>Kelurahan:</strong> {{ $posko->kelurahan }}</p>
                    @endif
                </div>
            </div>

            <!-- KAPASITAS POSKO -->
            <div class="info-group">
                <h3><i class="fas fa-users"></i> Kapasitas</h3>
                <div class="info-content">
                    <p><strong>Daya Tampung:</strong> {{ $posko->kapasitas }} orang</p>
                    <p><strong>Terisi:</strong> {{ $posko->jumlah_pengungsi }} orang</p>
                </div>
            </div>

            <!-- PENANGGUNG JAWAB -->
            <div class="info-group">
                <h3><i class="fas fa-user-tie"></i> Penanggung Jawab</h3>
                <div class="info-content">
                    <p><strong>Nama:</strong> {{ $posko->penanggung_jawab }}</p>
                    <p><strong>Kontak:</strong> {{ $posko->kontak }}</p>
                </div>
            </div>

            <!-- STATUS POSKO -->
            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Status Posko</h3>
                <div class="info-content">
                    <p><strong>Status:</strong> {{ $posko->status_posko }}</p>
                    <p><strong>Terakhir Update:</strong> {{ $posko->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- KETERANGAN TAMBAHAN -->
        @if($posko->keterangan)
        <div class="info-group">
            <h3><i class="fas fa-clipboard"></i> Keterangan Tambahan</h3>
            <div class="keterangan-box">
                <p>{{ $posko->keterangan }}</p>
            </div>
        </div>
        @endif

        <!-- BUTTON Aksi -->
        <div class="action-buttons">
            <a href="{{ route('posko.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> Lihat Semua Posko
            </a>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-donate"></i> Donasi untuk Posko
            </a>
        </div>
    </div>
</div>
<!-- END Content -->
@endsection
