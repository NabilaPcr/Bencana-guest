@extends('layout.guest.app')
@section('content')

{{-- <div class="container">
    <a href="{{ route('warga.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Warga
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>
                <i class="fas fa-user"></i>
                {{ $warga->nama }}
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-id-card me-1"></i>
                NIK: {{ $warga->no_ktp }}
            </p>
        </div>

        <div class="detail-grid">
            <!-- Data Pribadi -->
            <div class="info-group">
                <h3><i class="fas fa-user-circle"></i> Data Pribadi</h3>
                <div class="info-content">
                    <p><strong>Nama Lengkap:</strong> {{ $warga->nama }}</p>
                    <p><strong>NIK:</strong> {{ $warga->no_ktp }}</p>
                    <p><strong>Jenis Kelamin:</strong>
                        @if($warga->jenis_kelamin == 'L')
                            <i class="fas fa-male text-primary"></i> Laki-laki
                        @else
                            <i class="fas fa-female text-danger"></i> Perempuan
                        @endif
                    </p>
                    <p><strong>Agama:</strong> {{ $warga->agama }}</p>
                    <p><strong>Pekerjaan:</strong> {{ $warga->pekerjaan }}</p>
                </div>
            </div>

            <!-- Kontak -->
            <div class="info-group">
                <h3><i class="fas fa-address-book"></i> Kontak</h3>
                <div class="info-content">
                    <p><strong>No. Telepon:</strong>
                        <i class="fas fa-phone text-success me-1"></i>
                        {{ $warga->telp }}
                    </p>
                    @if($warga->email)
                        <p><strong>Email:</strong>
                            <i class="fas fa-envelope text-primary me-1"></i>
                            {{ $warga->email }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Alamat -->
            <div class="info-group">
                <h3><i class="fas fa-map-marker-alt"></i> Alamat</h3>
                <div class="info-content">
                    <p><strong>Alamat Lengkap:</strong>
                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                        {{ $warga->alamat }}
                    </p>
                    <p><strong>RT/RW:</strong>
                        <i class="fas fa-home text-primary me-1"></i>
                        {{ $warga->rt }}/{{ $warga->rw }}
                    </p>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Informasi Tambahan</h3>
                <div class="info-content">
                    <p><strong>ID Warga:</strong>
                        <i class="fas fa-hashtag me-1"></i>
                        {{ $warga->warga_id }}
                    </p>
                    @if($warga->kebutuhan_khusus)
                        <p><strong>Kebutuhan Khusus:</strong>
                            <i class="fas fa-info-circle text-warning me-1"></i>
                            {{ $warga->kebutuhan_khusus }}
                        </p>
                    @endif
                    @if($warga->keterangan)
                        <p><strong>Keterangan:</strong>
                            <i class="fas fa-sticky-note text-info me-1"></i>
                            {{ $warga->keterangan }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informasi Sistem -->
        <div class="info-group">
            <h3><i class="fas fa-database"></i> Informasi Sistem</h3>
            <div class="info-content">
                <p><strong>Dibuat Pada:</strong>
                    <i class="fas fa-calendar-plus me-1"></i>
                    {{ \Carbon\Carbon::parse($warga->created_at)->format('d F Y H:i') }}
                </p>
                <p><strong>Terakhir Diperbarui:</strong>
                    <i class="fas fa-calendar-check me-1"></i>
                    {{ \Carbon\Carbon::parse($warga->updated_at)->format('d F Y H:i') }}
                </p>
                <p><strong>Durasi Data:</strong>
                    @php
                        $daysCreated = $warga->created_at->diffInDays(now());
                    @endphp
                    @if($daysCreated == 0)
                        <span class="text-primary">Data dibuat hari ini</span>
                    @elseif($daysCreated == 1)
                        <span class="text-primary">Data dibuat kemarin</span>
                    @else
                        <span class="text-muted">{{ $daysCreated }} hari yang lalu</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons mt-5 pt-4 border-top">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i> Semua Warga
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i> Edit Data
                    </a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST"
                          class="d-inline w-100" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <a href="{{ route('warga.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Warga
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>
                <i class="fas fa-user"></i>
                {{ $warga->nama }}
            </h1>
            {{-- <p class="text-muted mb-0">
                <i class="fas fa-id-card me-1"></i>
                No KTP: {{ $warga->no_ktp }}
            </p> --}}
        </div>

        <div class="detail-grid">
            <div class="info-group">
                <h3><i class="fas fa-user-circle"></i> Data Pribadi</h3>
                <div class="info-content">
                    <p><strong>Nama Lengkap:</strong> {{ $warga->nama }}</p>
                    {{-- <p><strong>No KTP:</strong> {{ $warga->no_ktp }}</p> --}}
                    <p><strong>Jenis Kelamin:</strong>
                        @if($warga->jenis_kelamin == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif
                    </p>
                    <p><strong>Agama:</strong> {{ $warga->agama }}</p>
                    <p><strong>Pekerjaan:</strong> {{ $warga->pekerjaan }}</p>
                </div>
            </div>

            <div class="info-group">
                <h3><i class="fas fa-address-book"></i> Kontak</h3>
                <div class="info-content">
                    <p><strong>No. Telepon:</strong> {{ $warga->telp }}</p>
                    <p><strong>Email:</strong>
                        @if($warga->email)
                            {{ $warga->email }}
                        @else
                            <span class="text-muted">Tidak tercatat</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="info-group">
                <h3><i class="fas fa-map-marked-alt"></i> Alamat</h3>
                <div class="info-content">
                    <p><strong>Alamat Lengkap:</strong> {{ $warga->alamat }}</p>
                    <p><strong>RT/RW:</strong> {{ $warga->rt }}/{{ $warga->rw }}</p>
                </div>
            </div>

            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Informasi Tambahan</h3>
                <div class="info-content">
                    @if($warga->kebutuhan_khusus)
                        <p><strong>Kebutuhan Khusus:</strong> {{ $warga->kebutuhan_khusus }}</p>
                    @endif
                    @if($warga->keterangan)
                        <p><strong>Keterangan:</strong> {{ $warga->keterangan }}</p>
                    @endif
                    <p><strong>Dibuat:</strong> {{ $warga->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Terakhir Update:</strong> {{ $warga->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- GALERI FOTO -->
        {{-- <div class="info-group">
            <h3><i class="fas fa-camera"></i> Dokumentasi Warga</h3>

            @if(isset($files) && $files->count() > 0)
                <div class="alert alert-info d-flex align-items-center">
                    <i class="fas fa-info-circle fa-2x me-3"></i>
                    <div>
                        <strong>Informasi:</strong> Data foto tercatat di sistem, namun file asli belum diupload.
                        Silakan upload foto asli melalui menu edit.
                    </div>
                </div>

                <div class="row mt-3">
                    @foreach($files as $index => $file)
                        <div class="col-md-3 col-sm-6 col-12 mb-4">
                            <div class="card photo-card border">
                                <!-- Placeholder Image -->
                                <div class="d-flex justify-content-center align-items-center bg-light"
                                     style="height: 200px; overflow: hidden;">
                                    <img src="{{ asset('assets/images/placeholder.png') }}"
                                         alt="Placeholder - {{ $file->caption ?? 'Dokumentasi Warga' }}"
                                         style="width: 80%; height: auto; opacity: 0.7;">
                                </div>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary">
                                            <i class="fas fa-image me-1"></i> Foto {{ $index + 1 }}
                                        </span>
                                        <small class="text-muted">
                                            {{ $file->mime_type }}
                                        </small>
                                    </div>

                                    <h6 class="card-title mb-2">
                                        <i class="fas fa-file-alt me-1"></i>
                                        {{ $file->file_name }}
                                    </h6>

                                    @if($file->caption)
                                        <p class="card-text small text-muted mb-2">
                                            <i class="fas fa-comment me-1"></i>
                                            {{ $file->caption }}
                                        </p>
                                    @endif

                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">
                                            <i class="fas fa-sort-numeric-up me-1"></i>
                                            Urutan: {{ $file->sort_order }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $file->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-3">
                    <div class="badge bg-secondary">
                        <i class="fas fa-database me-1"></i>
                        Total: {{ $files->count() }} data tercatat
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <img src="{{ asset('assets/images/placeholder.png') }}"
                             alt="Tidak ada foto"
                             style="width: 150px; height: auto; opacity: 0.5;">
                    </div>
                    <h5 class="text-muted mb-3">
                        <i class="fas fa-images me-2"></i>
                        Belum ada dokumentasi foto
                    </h5>
                    <p class="text-muted">
                        Data foto untuk warga ini belum tercatat di sistem.
                    </p>
                    <a href="{{ route('warga.edit', $warga->warga_id) }}"
                       class="btn btn-primary mt-2">
                        <i class="fas fa-plus-circle me-1"></i>
                        Tambah Foto
                    </a>
                </div>
            @endif
        </div> --}}

        <!-- Lightbox Modal -->
        {{-- <div class="modal fade" id="imageLightbox" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lightboxTitle">
                            <i class="fas fa-image me-2"></i>Preview Foto
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center p-0">
                        <img src="" id="lightboxImage" class="img-fluid"
                             style="max-height: 70vh; object-fit: contain;">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Action Buttons -->
        <div class="action-buttons mt-5 pt-4 border-top">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i> Semua Warga
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i> Edit Data
                    </a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST"
                          class="d-inline w-100" onsubmit="return confirm('Hapus data warga ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .photo-card {
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }

    .photo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .status-badge {
        font-size: 0.8rem;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
    }

    .keterangan-box {
        background: #fff9e6;
        border-left: 4px solid #f39c12;
        padding: 20px;
        border-radius: 8px;
    }

    .info-content {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
</style>
@endpush

@push('scripts')
<script>
function openLightbox(imageSrc, caption) {
    document.getElementById('lightboxImage').src = imageSrc;
    document.getElementById('lightboxTitle').textContent = caption || 'Foto Warga';

    const lightbox = new bootstrap.Modal(document.getElementById('imageLightbox'));
    lightbox.show();
}

// Auto-highlight active photo on hover
document.addEventListener('DOMContentLoaded', function() {
    const photoCards = document.querySelectorAll('.photo-card');

    photoCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.borderColor = '#56a65a';
        });

        card.addEventListener('mouseleave', function() {
            this.style.borderColor = '#dee2e6';
        });
    });
});
</script>
@endpush
@endsection
