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

            <!-- TAMBAHAN: TAMPILKAN FOTO -->
            @if(isset($files) && $files->count() > 0)
            <div class="info-group">
                <h3><i class="fas fa-images"></i> Foto Dokumentasi</h3>
                <div class="row mt-3">
                    @foreach($files as $file)
                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card photo-card">
                            @if(str_contains($file->mime_type, 'image'))
                                <img src="{{ asset('storage/kejadian_bencana/' . $file->file_name) }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;"
                                     alt="Foto kejadian {{ $kejadian->jenis_bencana }}">
                            @else
                                <div class="text-center py-5 bg-light">
                                    <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                    <p class="mb-0">{{ $file->file_name }}</p>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <a href="{{ asset('storage/kejadian_bencana/' . $file->file_name) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-download me-1"></i> Download
                                </a>
                                @if($file->caption)
                                <p class="mt-2 mb-0 small text-muted">{{ $file->caption }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="info-group">
                <h3><i class="fas fa-images"></i> Foto Dokumentasi</h3>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada foto dokumentasi untuk kejadian ini.
                </div>
            </div>
            @endif

            <div class="action-buttons mt-4">
                <a href="{{ route('kejadian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i> Lihat Semua Kejadian
                </a>
                {{-- GANTI KODE DIBAWAH JADI MENGARAH KE HALAMAN  DONASI --}}
                <a href="{{ route('kejadian.edit', $kejadian->kejadian_id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i> Edit Kejadian
                </a>

            </div>
        </div>
    </div>
@endsection
