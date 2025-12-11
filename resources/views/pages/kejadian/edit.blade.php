@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('kejadian.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Kejadian
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Kejadian Bencana</h1>
                <p>Perbarui data kejadian bencana berikut</p>
            </div>

            <form action="{{ route('kejadian.update', $kejadian->kejadian_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="jenis_bencana">Jenis Bencana *</label>
                    <input type="text" id="jenis_bencana" name="jenis_bencana" required
                        value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}"
                        placeholder="Contoh: Banjir, Gempa Bumi, Kebakaran">
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Kejadian *</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        value="{{ old('tanggal', $kejadian->tanggal->format('Y-m-d')) }}">
                </div>

                <div class="form-group">
                    <label for="lokasi_text">Lokasi Kejadian *</label>
                    <textarea id="lokasi_text" name="lokasi_text" required placeholder="Deskripsikan lokasi kejadian dengan jelas">{{ old('lokasi_text', $kejadian->lokasi_text) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt', $kejadian->rt) }}"
                            placeholder="Contoh: 05">
                    </div>

                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" id="rw" name="rw" value="{{ old('rw', $kejadian->rw) }}"
                            placeholder="Contoh: 02">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dampak">Dampak yang Terjadi *</label>
                    <textarea id="dampak" name="dampak" required
                        placeholder="Deskripsikan dampak yang terjadi, contoh: 50 rumah terendam, 200 warga mengungsi">{{ old('dampak', $kejadian->dampak) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status_kejadian">Status Kejadian *</label>
                    <select id="status_kejadian" name="status_kejadian" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif"
                            {{ old('status_kejadian', $kejadian->status_kejadian) == 'aktif' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="dalam penanganan"
                            {{ old('status_kejadian', $kejadian->status_kejadian) == 'dalam penanganan' ? 'selected' : '' }}>
                            Dalam Penanganan</option>
                        <option value="selesai"
                            {{ old('status_kejadian', $kejadian->status_kejadian) == 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan Tambahan</label>
                    <textarea id="keterangan" name="keterangan" placeholder="Informasi tambahan tentang kejadian ini">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                </div>

                <!-- ✅ FOTO YANG SUDAH ADA - HANYA ICON -->
                @if ($files->count() > 0)
                    <div class="form-group mt-4">
                        <label class="fw-bold mb-3">Foto yang sudah diupload</label>
                        <div class="row">
                            @foreach ($files as $file)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="position-relative">
                                        <!-- Gambar -->
                                        <img src="{{ asset('storage/uploads/kejadian_bencana/' . $file->file_name) }}"
                                            class="img-thumbnail w-100" style="height: 120px; object-fit: cover;">

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
                            Klik untuk memilih foto yang akan dihapus
                        </div>
                    </div>
                @endif
                <!-- ✅ UPLOAD FOTO BARU -->
                <div class="form-group mt-4">
                    <label class="fw-bold">Upload Foto Baru (Opsional)</label>
                    <small class="text-muted d-block mb-2">
                        Format: JPG, PNG, GIF. Maksimal 2MB per file.
                    </small>

                    <!-- Input file multiple -->
                    <input type="file" name="fotos[]" class="form-control" accept="image/*" multiple>

                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-lightbulb"></i>
                            Kosongkan jika tidak ingin menambah foto baru.
                        </small>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('kejadian.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit btn-submit-full">
                        <i class="fas fa-save"></i> Update Data Kejadian
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
