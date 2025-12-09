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
                <!-- File Upload Section - SAMA SEPERTI CONTOH PELANGGAN -->
                <div class="form-group">
                    <label for="files">Tambah Foto Dokumentasi</label>
                    <input type="file" class="form-control" id="files" name="files[]" multiple
                        accept="image/*,.pdf,.doc,.docx">
                    <small class="text-muted">
                        Dapat memilih multiple file. Format yang didukung: JPG, JPEG, PNG, PDF, DOC, DOCX.
                        Maksimal 2MB per file.
                    </small>
                </div>

                <!-- List Existing Files - SAMA SEPERTI CONTOH PELANGGAN -->
                @if ($files->count() > 0)
                    <div class="form-group">
                        <label>File yang sudah diupload:</label>
                        <div class="list-files">
                            @foreach ($files as $file)
                                <div
                                    class="file-item d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                                    <div>
                                        <i class="far fa-file me-2"></i>
                                        {{ $file->file_name }}
                                        <small class="text-muted ms-2">({{ $file->mime_type }})</small>
                                    </div>
                                    <div>
                                        <a href="{{ asset('storage/kejadian_bencana/' . $file->file_name) }}"
                                            target="_blank" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="far fa-eye"></i> Lihat
                                        </a>
                                        <form action="{{ route('kejadian.destroyFile', $file->media_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus file ini?')">
                                                <i class="far fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


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
