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
                <i class="fas fa-hospital-alt"></i>
                {{ $posko->nama }}
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-map-marker-alt me-1"></i>
                {{ $posko->alamat }}
            </p>
        </div>

        <div class="detail-grid">
            <div class="info-group">
                <h3><i class="fas fa-map-marked-alt"></i> Lokasi Posko</h3>
                <div class="info-content">
                    <p><strong>Alamat Lengkap:</strong> {{ $posko->alamat }}</p>
                    <p><strong>Kontak Lokasi:</strong> {{ $posko->kontak }}</p>
                </div>
            </div>
            <div class="info-group">
                <h3><i class="fas fa-exclamation-triangle"></i> Kejadian Terkait</h3>
                <div class="info-content">
                    <p><strong>Jenis Bencana:</strong> {{ $posko->kejadian->jenis_bencana ?? 'Tidak diketahui' }}</p>
                    <p><strong>Tanggal Kejadian:</strong> {{ optional($posko->kejadian)->tanggal ? $posko->kejadian->tanggal->format('d F Y') : 'Tidak diketahui' }}</p>
                    <p><strong>Lokasi Bencana:</strong> {{ $posko->kejadian->lokasi_text ?? 'Tidak diketahui' }}</p>
                </div>
            </div>
            <div class="info-group">
                <h3><i class="fas fa-user-tie"></i> Penanggung Jawab</h3>
                <div class="info-content">
                    <p><strong>Nama:</strong> {{ $posko->penanggung_jawab }}</p>
                    <p><strong>Kontak:</strong> {{ $posko->kontak }}</p>
                    <p><strong>Dibuat:</strong> {{ $posko->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Informasi</h3>
                <div class="info-content">
                    <p><strong>ID Posko:</strong> {{ $posko->posko_id }}</p>
                    <p><strong>Terakhir Update:</strong> {{ $posko->updated_at->format('d M Y H:i') }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>Aktif
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="info-group">
            <h3><i class="fas fa-images"></i> Dokumentasi Posko</h3>

            @php
                $files = $posko->media;
                $images = $posko->getImagesUrls();
                $hasRealImages = $posko->hasRealImages;
            @endphp

            @if($files->count() > 0)
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
                                    <img src="{{ $posko->getImageUrl($file->file_name) }}"
                                         alt="Placeholder - {{ $file->caption ?? 'Dokumentasi Posko' }}"
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
                                            {{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y') }}
                                        </small>
                                    </div>

                                    @if($posko->isPlaceholder($file->file_name))
                                        <div class="mt-2">
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Placeholder
                                            </span>
                                        </div>
                                    @endif
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
                    @if(!$hasRealImages)
                        <div class="badge bg-warning text-dark mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Semua data adalah placeholder
                        </div>
                    @endif
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
                        Data foto untuk posko ini belum tercatat di sistem.
                    </p>
                    <a href="{{ route('posko.edit', $posko->posko_id) }}"
                       class="btn btn-primary mt-2">
                        <i class="fas fa-plus-circle me-1"></i>
                        Tambah Foto
                    </a>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="detail-action-buttons">
                <div class="row g-3">
                    <div class="col-md-4">
                    <a href="{{ route('posko.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i>daftar Posko
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('posko.edit', $posko->posko_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('posko.destroy', $posko->posko_id) }}" method="POST"
                          class="d-inline w-100" onsubmit="return confirm('Hapus data posko ini?')">
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
<!-- END MAIN CONTENT -->
@endsection

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

    .action-buttons .btn {
        padding: 12px;
        font-weight: 500;
    }
</style>
@endpush
