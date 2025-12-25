@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('distribusi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Distribusi
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>
                <i class="fas fa-truck"></i>
                Distribusi Logistik #{{ $distribusi->distribusi_id }}
            </h1>

            <!-- Status Distribusi Badge -->
            <div class="status-badge-container mt-3">
                @if($distribusi->jumlah > 50)
                    <span class="status-badge" style="background: #e8f4fd; color: #3498db; border-color: #3498db;">
                        <i class="fas fa-boxes"></i> Distribusi Besar
                    </span>
                @elseif($distribusi->jumlah > 10)
                    <span class="status-badge" style="background: #eafaf1; color: #27ae60; border-color: #27ae60;">
                        <i class="fas fa-box"></i> Distribusi Sedang
                    </span>
                @else
                    <span class="status-badge" style="background: #fff3cd; color: #856404; border-color: #856404;">
                        <i class="fas fa-box-open"></i> Distribusi Kecil
                    </span>
                @endif

                <span class="badge bg-primary ms-2">
                    <i class="fas fa-calendar-alt"></i> {{ $distribusi->tanggal_formatted }}
                </span>
            </div>
        </div>

        <!-- Informasi Utama (Grid) -->
        <div class="detail-grid">
            <!-- INFORMASI DISTRIBUSI -->
            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Informasi Distribusi</h3>
                <div class="info-content">
                    <p><strong>Tanggal Distribusi:</strong> {{ $distribusi->tanggal_formatted }}</p>
                    <p><strong>Penerima:</strong> {{ $distribusi->penerima }}</p>
                    <p><strong>Lokasi:</strong> {{ $distribusi->lokasi ?? 'Tidak ditentukan' }}</p>
                    <p><strong>Keterangan:</strong>
                        @if($distribusi->keterangan)
                            {{ $distribusi->keterangan }}
                        @else
                            <span class="text-muted"><i>Tidak ada keterangan</i></span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- LOGISTIK YANG DIDISTRIBUSIKAN -->
            <div class="info-group">
                <h3><i class="fas fa-box"></i> Logistik yang Didistribusikan</h3>
                <div class="info-content">
                    @if($distribusi->logistik)
                        <p><strong>Nama Barang:</strong> {{ $distribusi->logistik->nama_barang }}</p>
                        <p><strong>Jumlah:</strong>
                            <span style="font-size: 1.3rem; font-weight: bold; color: #2e6d38;">
                                {{ $distribusi->jumlah }}
                            </span> {{ $distribusi->logistik->satuan }}
                        </p>
                        <p><strong>Stok Tersedia:</strong> {{ $distribusi->logistik->stok }} {{ $distribusi->logistik->satuan }}</p>
                        <p><strong>Sumber Logistik:</strong> {{ $distribusi->logistik->sumber ?? 'Tidak diketahui' }}</p>
                    @else
                        <p class="text-muted"><i>Data logistik tidak ditemukan</i></p>
                    @endif
                </div>
            </div>

            <!-- POSKO TUJUAN -->
            <div class="info-group">
                <h3><i class="fas fa-map-marker-alt"></i> Posko Tujuan</h3>
                <div class="info-content">
                    @if($distribusi->posko)
                        <p><strong>Nama Posko:</strong> {{ $distribusi->posko->nama }}</p>
                        <p><strong>Alamat:</strong> {{ $distribusi->posko->alamat }}</p>
                        <p><strong>Kontak:</strong> {{ $distribusi->posko->kontak ?? 'Tidak tersedia' }}</p>
                        <p><strong>Penanggung Jawab:</strong> {{ $distribusi->posko->penanggung_jawab ?? 'Tidak ditentukan' }}</p>
                    @else
                        <p class="text-muted"><i>Data posko tidak ditemukan</i></p>
                    @endif
                </div>
            </div>

            <!-- INFORMASI KEJADIAN -->
            <div class="info-group">
                <h3><i class="fas fa-exclamation-triangle"></i> Kejadian Terkait</h3>
                <div class="info-content">
                    @if($distribusi->posko && $distribusi->posko->kejadian)
                        <p><strong>Jenis Bencana:</strong> {{ $distribusi->posko->kejadian->jenis_bencana }}</p>
                        <p><strong>Tanggal Kejadian:</strong> {{ \Carbon\Carbon::parse($distribusi->posko->kejadian->tanggal)->format('d F Y') }}</p>
                        <p><strong>Lokasi:</strong> {{ $distribusi->posko->kejadian->lokasi_text }}</p>
                        <p><strong>Status:</strong>
                            @php
                                $statusClass = [
                                    'aktif' => 'danger',
                                    'selesai' => 'success',
                                    'dalam penanganan' => 'warning',
                                ][$distribusi->posko->kejadian->status_kejadian] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ ucfirst($distribusi->posko->kejadian->status_kejadian) }}
                            </span>
                        </p>
                    @else
                        <p class="text-muted"><i>Data kejadian tidak ditemukan</i></p>
                    @endif
                </div>
            </div>
        </div>

        <!-- BUKTI DISTRIBUSI (Card terpisah di bawah grid) -->
        @php
            $files = $distribusi->getMediaFiles();
        @endphp

        @if($files->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-camera"></i> Bukti Distribusi</h4>
                    <small class="text-muted">Total: {{ $files->count() }} bukti foto</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($files as $index => $file)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="bukti-card position-relative">
                                    <div class="bukti-image">
                                        <img src="{{ $distribusi->getImageUrl($file->file_name) }}"
                                             class="img-thumbnail w-100"
                                             style="height: 120px; object-fit: cover; cursor: pointer;"
                                             onclick="showImageModal('{{ $distribusi->getImageUrl($file->file_name) }}', '{{ $file->caption ?? 'Bukti Distribusi' }}')"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             alt="{{ $file->caption ?? 'Bukti ' . ($index + 1) }}">
                                    </div>
                                    <div class="text-center mt-2">
                                        <small class="text-muted d-block">Foto {{ $index + 1 }}</small>
                                        @if($file->caption)
                                            <small class="text-muted">{{ Str::limit($file->caption, 30) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if(!$distribusi->has_real_bukti)
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Gambar yang ditampilkan adalah placeholder. Belum ada foto asli yang diupload.
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-camera"></i> Bukti Distribusi</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada bukti foto distribusi.
                    </div>
                </div>
            </div>
        @endif

        <!-- STATISTIK STOK (Card terpisah di bawah bukti) -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Stok</h4>
            </div>
            <div class="card-body">
                @if($distribusi->logistik)
                    @php
                        $stokSekarang = $distribusi->logistik->stok;
                        $stokSebelum = $stokSekarang + $distribusi->jumlah;
                        $persentase = ($stokSekarang / $stokSebelum) * 100;
                    @endphp

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="50%">Stok Sebelum Distribusi:</th>
                                    <td>{{ $stokSebelum }} {{ $distribusi->logistik->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Didistribusikan:</th>
                                    <td>
                                        <span class="fw-bold" style="color: #e74c3c;">
                                            {{ $distribusi->jumlah }} {{ $distribusi->logistik->satuan }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Stok Sekarang:</th>
                                    <td>
                                        <span class="fw-bold" style="color: #27ae60;">
                                            {{ $stokSekarang }} {{ $distribusi->logistik->satuan }}
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <div class="progress mt-4" style="height: 25px;">
                                <div class="progress-bar bg-success"
                                     role="progressbar"
                                     style="width: {{ $persentase }}%"
                                     aria-valuenow="{{ $persentase }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                    <strong>{{ round($persentase, 1) }}%</strong>
                                </div>
                            </div>
                            <small class="text-muted d-block mt-2">
                                Persentase stok tersisa setelah distribusi
                            </small>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div style="font-size: 3rem; color: #2e6d38;">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h3 style="color: {{ $stokSekarang > 0 ? '#27ae60' : '#e74c3c' }};">
                                    {{ $stokSekarang }}
                                </h3>
                                <p class="text-muted">Stok Tersisa</p>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-muted"><i>Data statistik tidak tersedia</i></p>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons mt-5 pt-4 border-top">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('distribusi.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i> Daftar Distribusi
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('distribusi.edit', $distribusi->distribusi_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-trash me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                </div>
                <h5 class="text-center mb-3">Hapus Distribusi Ini?</h5>
                <p class="text-center">
                    <strong>{{ $distribusi->penerima }}</strong><br>
                    {{ $distribusi->jumlah }} {{ $distribusi->logistik->satuan ?? '' }}
                    {{ $distribusi->logistik->nama_barang ?? '' }}<br>
                    <small class="text-muted">{{ $distribusi->tanggal_formatted }}</small>
                </p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Data distribusi dan bukti foto akan dihapus secara permanen.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('distribusi.destroy', $distribusi->distribusi_id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Preview">
            </div>
            <div class="modal-footer">
                <p id="imageCaption" class="text-muted mb-0"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #2e6d38;
        text-decoration: none;
        font-weight: 500;
    }

    .back-link:hover {
        color: #1e4d27;
        text-decoration: underline;
    }

    .detail-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        padding: 30px;
        margin-top: 20px;
    }

    .detail-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .detail-header h1 {
        color: #2e6d38;
        font-weight: 600;
    }

    .status-badge-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 2px solid;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .info-group h3 {
        color: #2e6d38;
        font-size: 1.2rem;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #56a65a;
    }

    .info-content {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        min-height: 200px;
    }

    .info-content p {
        margin-bottom: 10px;
    }

    .info-content strong {
        color: #495057;
        min-width: 180px;
        display: inline-block;
    }

    .bukti-card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px;
        background: white;
        transition: all 0.3s ease;
    }

    .bukti-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .bukti-image {
        width: 100%;
        height: 120px;
        overflow: hidden;
        border-radius: 5px;
    }

    .bukti-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .bukti-card:hover .bukti-image img {
        transform: scale(1.05);
    }

    .action-buttons .btn {
        padding: 12px;
        font-weight: 500;
    }

    .progress {
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }

    .card {
        border: 1px solid rgba(0,0,0,.125);
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: 15px 20px;
    }

    .card-header h4 {
        color: #2e6d38;
        margin: 0;
    }

    .table-borderless th {
        color: #495057;
        font-weight: 600;
    }

    /* Modal styles */
    #imageModal .modal-body img {
        max-height: 70vh;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .detail-card {
            padding: 20px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .action-buttons .btn {
            margin-bottom: 10px;
        }

        .info-content {
            padding: 15px;
            min-height: auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
function showImageModal(imageUrl, caption) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageCaption').textContent = caption || 'Bukti Distribusi';

    // Reset modal jika gambar gagal dimuat
    document.getElementById('modalImage').onerror = function() {
        this.src = '{{ asset("assets/images/placeholder.png") }}';
    };
}

// Keyboard navigation untuk modal gambar
document.addEventListener('keydown', function(e) {
    const imageModal = document.getElementById('imageModal');
    if (imageModal.classList.contains('show')) {
        if (e.key === 'Escape') {
            bootstrap.Modal.getInstance(imageModal).hide();
        }
    }
});

// Auto focus ke modal delete jika ada error
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.hide();
    });
@endif

// Highlight jumlah distribusi besar
document.addEventListener('DOMContentLoaded', function() {
    const jumlah = {{ $distribusi->jumlah }};
    if (jumlah > 100) {
        // Tambahkan class highlight untuk jumlah besar
        const jumlahElements = document.querySelectorAll('.fw-bold[style*="color: #e74c3c"]');
        jumlahElements.forEach(el => {
            el.classList.add('text-decoration-underline');
        });
    }
});
</script>
@endpush
