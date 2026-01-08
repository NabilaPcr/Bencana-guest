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
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $kejadian->jenis_bencana }}
                    <span class="status-badge status-{{ str_replace(' ', '-', $kejadian->status_kejadian) }}">
                        {{ ucfirst($kejadian->status_kejadian) }}
                    </span>
                </h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-map-marker-alt me-1"></i>
                    {{ $kejadian->lokasi_text }}
                </p>
            </div>

            <div class="detail-grid">
                <div class="info-group">
                    <h3><i class="fas fa-map-marked-alt"></i> Lokasi Detail</h3>
                    <div class="info-content">
                        <p><strong>Alamat Lengkap:</strong> {{ $kejadian->lokasi_text }}</p>
                        <p><strong>RT/RW:</strong>
                            @if ($kejadian->rt && $kejadian->rw)
                                {{ $kejadian->rt }}/{{ $kejadian->rw }}
                            @else
                                <span class="text-muted">Tidak tercatat</span>
                            @endif
                        </p>
                        <p><strong>Koordinat:</strong>
                            <span class="text-muted">Belum tersedia</span>
                        </p>
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-calendar-day"></i> Waktu Kejadian</h3>
                    <div class="info-content">
                        <p><strong>Tanggal:</strong> {{ $kejadian->tanggal->format('d F Y') }}</p>
                        <p><strong>Hari:</strong> {{ $kejadian->tanggal->translatedFormat('l') }}</p>
                        <p><strong>Durasi:</strong>
                            @php
                                $daysAgo = $kejadian->tanggal->diffInDays(now());
                            @endphp
                            @if ($daysAgo == 0)
                                Hari ini
                            @elseif($daysAgo == 1)
                                Kemarin
                            @else
                                {{ $daysAgo }} hari yang lalu
                            @endif
                        </p>
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-fire-alt"></i> Dampak & Kerusakan</h3>
                    <div class="info-content">
                        <p>{{ $kejadian->dampak }}</p>
                        @if ($kejadian->status_kejadian == 'selesai')
                            <p class="text-success mb-0">
                                <i class="fas fa-check-circle me-1"></i>
                                Penanganan telah selesai
                            </p>
                        @endif
                    </div>
                </div>

                <div class="info-group">
                    <h3><i class="fas fa-tasks"></i> Status Penanganan</h3>
                    <div class="info-content">
                        <p><strong>Status:</strong>
                            <span
                                class="badge
                                @if ($kejadian->status_kejadian == 'aktif') bg-danger
                                @elseif($kejadian->status_kejadian == 'dalam penanganan') bg-warning text-dark
                                @else bg-success @endif">
                                {{ ucfirst($kejadian->status_kejadian) }}
                            </span>
                        </p>
                        <p><strong>Dibuat:</strong> {{ $kejadian->created_at->format('d M Y H:i') }}</p>
                        <p><strong>Terakhir Update:</strong> {{ $kejadian->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            @if ($kejadian->keterangan)
                <div class="info-group">
                    <h3><i class="fas fa-clipboard-list"></i> Keterangan Tambahan</h3>
                    <div class="keterangan-box">
                        <p class="mb-0">{{ $kejadian->keterangan }}</p>
                    </div>
                </div>
            @endif
            <!-- Tambahkan bagian ini di dalam detail-card, sebelum action buttons -->
            @if ($kejadian->posko->count() > 0)
                <div class="info-group">
                    <h3><i class="fas fa-first-aid"></i> Posko Penanganan</h3>
                    <div class="info-content">
                        <div class="posko-list-detail">
                            @foreach ($kejadian->posko as $posko)
                                <div class="posko-item-detail">
                                    <h5>
                                        <i class="fas fa-hospital"></i>
                                        {{ $posko->nama }}
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><i class="fas fa-user"></i> <strong>Penanggung Jawab:</strong>
                                                {{ $posko->penanggung_jawab }}</p>
                                            <p><i class="fas fa-phone"></i> <strong>Kontak:</strong> {{ $posko->kontak }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><i class="fas fa-map-marker-alt"></i> <strong>Lokasi Posko:</strong>
                                                {{ $posko->alamat }}</p>
                                            <p class="text-end">
                                                <a href="{{ route('posko.show', $posko->posko_id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i> Detail Posko
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="info-group">
                    <h3><i class="fas fa-first-aid"></i> Posko Penanganan</h3>
                    <div class="info-content">
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Belum ada posko yang ditugaskan untuk menangani kejadian ini</p>
                            <a href="{{ route('posko.create') }}?kejadian_id={{ $kejadian->kejadian_id }}"
                                class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Tambah Posko
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- GALERI FOTO -->
            <div class="info-group">
                <h3><i class="fas fa-camera"></i> Dokumentasi Kejadian</h3>

                @if (isset($files) && $files->count() > 0)
                    <div class="row mt-3">
                        @foreach ($files as $index => $file)
                            <div class="col-md-3 col-sm-6 col-12 mb-4">
                                <div class="card photo-card border">
                                    <!-- Placeholder Image -->
                                    <div class="d-flex justify-content-center align-items-center bg-light"
                                        style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('assets/images/placeholder.png') }}"
                                            alt="Placeholder - {{ $file->caption ?? 'Dokumentasi' }}"
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

                                        @if ($file->caption)
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
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="Tidak ada foto"
                                style="width: 150px; height: auto; opacity: 0.5;">
                        </div>
                        <h5 class="text-muted mb-3">
                            <i class="fas fa-images me-2"></i>
                            Belum ada dokumentasi foto
                        </h5>
                        <p class="text-muted">
                            Data foto untuk kejadian ini belum tercatat di sistem.
                        </p>
                        <a href="{{ route('kejadian.edit', $kejadian->kejadian_id) }}" class="btn btn-primary mt-2">
                            <i class="fas fa-plus-circle me-1"></i>
                            Tambah Foto
                        </a>
                    </div>
                @endif
            </div>

            <!-- Lightbox Modal -->
            <div class="modal fade" id="imageLightbox" tabindex="-1">
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
            </div>

            <!-- Action Buttons -->
            <div class="detail-action-buttons">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('kejadian.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i> Semua Kejadian
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('kejadian.edit', $kejadian->kejadian_id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i> Edit Data
                        </a>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('kejadian.destroy', $kejadian->kejadian_id) }}" method="POST"
                            class="d-inline w-100" onsubmit="return confirm('Hapus data kejadian ini?')">
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 0.8rem;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-aktif {
            background: #ffeaea;
            color: #d63031;
        }

        .status-dalam-penanganan {
            background: #fef5e7;
            color: #e67e22;
        }

        .status-selesai {
            background: #eafaf1;
            color: #27ae60;
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

        /* CSS untuk posko di halaman detail kejadian */
        .posko-list-detail {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .posko-item-detail {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .posko-item-detail:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .posko-item-detail h5 {
            color: var(--dark);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .posko-item-detail p {
            margin-bottom: 8px;
            color: #555;
        }

        .posko-item-detail i {
            color: var(--primary);
            width: 16px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function openLightbox(imageSrc, caption) {
            document.getElementById('lightboxImage').src = imageSrc;
            document.getElementById('lightboxTitle').textContent = caption || 'Foto Kejadian';

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
