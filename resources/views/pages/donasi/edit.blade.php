@extends('layout.guest.app')
@section('content')
    <div class="container">
        <a href="{{ route('donasi.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Donasi
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Donasi Bencana</h1>
                <p>Perbarui data donasi berikut</p>
            </div>

            <form action="{{ route('donasi.update', $donasiBencana->donasi_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ... field existing donasi ... -->

                <!-- ✅ BUKTI DONASI YANG SUDAH ADA -->
                @if ($files->count() > 0)
                    <div class="form-group mt-4">
                        <label class="fw-bold mb-3">Bukti Donasi yang sudah diupload</label>
                        <div class="row">
                            @foreach ($files as $file)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="position-relative">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <img src="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                class="img-thumbnail w-100"
                                                style="height: 120px; object-fit: cover;">
                                        @else
                                            <div class="img-thumbnail w-100 d-flex align-items-center justify-content-center"
                                                 style="height: 120px; background: #f8f9fa;">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                            </div>
                                        @endif

                                        <!-- Checkbox kecil di pojok -->
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_media[]"
                                                    value="{{ $file->media_id }}" id="delete_media_{{ $file->media_id }}">
                                                <label class="form-check-label text-danger"
                                                    for="delete_media_{{ $file->media_id }}">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="alert alert-info py-2 mt-2">
                            <i class="fas fa-info-circle me-2"></i>
                            Klik kotak untuk memilih bukti yang akan dihapus
                        </div>
                    </div>
                @endif

                <!-- ✅ UPLOAD BUKTI DONASI BARU -->
                <div class="form-group mt-4">
                    <label class="fw-bold">Upload Bukti Donasi Baru (Opsional)</label>
                    <small class="text-muted d-block mb-2">
                        Format: JPG, PNG, GIF, PDF. Maksimal 2MB per file.
                    </small>

                    <input type="file" name="bukti_donasi[]" class="form-control" accept="image/*,.pdf" multiple>

                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-lightbulb"></i>
                            Kosongkan jika tidak ingin menambah bukti baru.
                        </small>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('donasi.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit btn-submit-full">
                        <i class="fas fa-save"></i> Update Data Donasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
