@extends('layout.guest.app')
@section('content')
<!-- MAIN CONTENT -->
<div class="container">
    <a href="{{ route('logistik.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Daftar Logistik
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h1>
                <i class="fas fa-box"></i>
                {{ $logistik->nama_barang }}
            </h1>

            <!-- Status Stok Badge -->
            <div class="status-badge-container mt-3">
                @if($logistik->stok > 50)
                    <span class="status-badge" style="background: #eafaf1; color: #27ae60; border-color: #27ae60;">
                        <i class="fas fa-check-circle"></i> Stok Cukup
                    </span>
                @elseif($logistik->stok > 10)
                    <span class="status-badge" style="background: #fef5e7; color: #f39c12; border-color: #f39c12;">
                        <i class="fas fa-exclamation-triangle"></i> Stok Menipis
                    </span>
                @else
                    <span class="status-badge" style="background: #ffeaea; color: #e74c3c; border-color: #e74c3c;">
                        <i class="fas fa-times-circle"></i> Stok Kritis
                    </span>
                @endif

                <span class="badge bg-primary ms-2">
                    <i class="fas fa-cube"></i> {{ $logistik->stok }} {{ $logistik->satuan }}
                </span>
            </div>
        </div>

        <div class="detail-grid">
            <!-- INFORMASI LOGISTIK -->
            <div class="info-group">
                <h3><i class="fas fa-info-circle"></i> Informasi Logistik</h3>
                <div class="info-content">
                    <p><strong>Nama Barang:</strong> {{ $logistik->nama_barang }}</p>
                    <p><strong>Satuan:</strong> {{ $logistik->satuan }}</p>
                    <p><strong>Stok Tersedia:</strong>
                        <span style="font-size: 1.3rem; font-weight: bold;
                            color: {{ $logistik->stok > 50 ? '#27ae60' : ($logistik->stok > 10 ? '#f39c12' : '#e74c3c') }}">
                            {{ $logistik->stok }}
                        </span> {{ $logistik->satuan }}
                    </p>
                    <p><strong>Sumber:</strong> {{ $logistik->sumber ?? 'Tidak diketahui' }}</p>
                </div>
            </div>

            <!-- KEJADIAN BENCANA -->
            <div class="info-group">
                <h3><i class="fas fa-exclamation-triangle"></i> Kejadian Terkait</h3>
                <div class="info-content">
                    @if($logistik->kejadian)
                        <p><strong>Jenis Bencana:</strong> {{ $logistik->kejadian->jenis_bencana }}</p>
                        <p><strong>Tanggal Kejadian:</strong> {{ $logistik->kejadian->tanggal->format('d F Y') }}</p>
                        <p><strong>Lokasi:</strong> {{ $logistik->kejadian->lokasi_text }}</p>
                        <p><strong>RT/RW:</strong> RT {{ $logistik->kejadian->rt }}/RW {{ $logistik->kejadian->rw }}</p>
                        <p><strong>Status Kejadian:</strong>
                            @if($logistik->kejadian->status_kejadian == 'aktif')
                                <span class="badge bg-danger">Aktif</span>
                            @elseif($logistik->kejadian->status_kejadian == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning text-dark">Dalam Penanganan</span>
                            @endif
                        </p>
                    @else
                        <p class="text-muted"><i>Data kejadian tidak ditemukan</i></p>
                    @endif
                </div>
            </div>

            <!-- INFORMASI TAMBAHAN -->
            <div class="info-group">
                <h3><i class="fas fa-calendar-alt"></i> Informasi Sistem</h3>
                <div class="info-content">
                    <p><strong>ID Logistik:</strong> {{ $logistik->logistik_id }}</p>
                    <p><strong>Dibuat:</strong> {{ $logistik->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Terakhir Update:</strong> {{ $logistik->updated_at->format('d M Y H:i') }}</p>
                    <p><strong>Status:</strong>
                        @if($logistik->stok > 50)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Tersedia
                            </span>
                        @elseif($logistik->stok > 0)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-exclamation-triangle me-1"></i>Terbatas
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="fas fa-times-circle me-1"></i>Habis
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- UPDATE STOK -->
            <div class="info-group">
                <h3><i class="fas fa-sync-alt"></i> Update Stok</h3>
                <div class="info-content">
                    <form action="{{ route('logistik.updateStok', $logistik->logistik_id) }}" method="POST"
                          onsubmit="return validateStokUpdate()">
                        @csrf
                        @method('PATCH')

                        <div class="row g-3 align-items-end">
                            <div class="col-md-7">
                                <label for="stok_update" class="form-label">Stok Baru</label>
                                <div class="input-group">
                                    <input type="number" id="stok_update" name="stok"
                                           class="form-control"
                                           value="{{ $logistik->stok }}"
                                           min="0" step="1" required>
                                    <span class="input-group-text bg-light">{{ $logistik->satuan }}</span>
                                </div>
                                <small class="text-muted">Masukkan jumlah stok yang baru</small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea id="catatan" name="catatan"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Catatan perubahan stok..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="detail-action-buttons">
                <div class="row g-3">
                    <div class="col-md-4">
                    <a href="{{ route('logistik.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-list me-2"></i> Daftar Logistik
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('logistik.edit', $logistik->logistik_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-2"></i> Edit
                    </a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('logistik.destroy', $logistik->logistik_id) }}" method="POST"
                          class="d-inline w-100" onsubmit="return confirmDelete()">
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

    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }
</style>
@endpush

@push('scripts')
<script>
function validateStokUpdate() {
    const stokInput = document.getElementById('stok_update');
    const stokValue = parseInt(stokInput.value);

    if (isNaN(stokValue) || stokValue < 0) {
        alert('Stok harus berupa angka positif!');
        stokInput.focus();
        return false;
    }

    return confirm('Apakah Anda yakin ingin mengupdate stok?');
}

function confirmDelete() {
    const barangName = "{{ $logistik->nama_barang }}";
    return confirm(`Apakah Anda yakin ingin menghapus logistik "${barangName}"?\nData yang sudah dihapus tidak dapat dikembalikan.`);
}

// Stok indicator color
document.addEventListener('DOMContentLoaded', function() {
    const stok = {{ $logistik->stok }};
    const stokElement = document.querySelector('[style*="font-size: 1.3rem"]');

    if (stok <= 10) {
        // Add blinking effect for critical stock
        setInterval(() => {
            stokElement.style.opacity = stokElement.style.opacity === '0.5' ? '1' : '0.5';
        }, 1000);
    }
});
</script>
@endpush
