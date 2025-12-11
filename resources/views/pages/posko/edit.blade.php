@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('posko.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Posko
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Posko Bencana</h1>
                <p>Perbarui data posko bencana berikut</p>
            </div>

            <form action="{{ route('posko.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="posko_id">ID Posko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('posko_id') is-invalid @enderror"
                                   id="posko_id" name="posko_id"
                                   value="{{ old('posko_id', $posko->posko_id) }}"
                                   readonly style="background-color: #f8f9fa;">
                            <small class="form-text text-muted">ID Posko tidak dapat diubah</small>
                            @error('posko_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kejadian_id">Kejadian Bencana <span class="text-danger">*</span></label>
                            <select class="form-control @error('kejadian_id') is-invalid @enderror"
                                    id="kejadian_id" name="kejadian_id" required>
                                <option value="">Pilih Kejadian Bencana</option>
                                @foreach($kejadianList as $kejadian)
                                    <option value="{{ $kejadian->kejadian_id }}"
                                        {{ old('kejadian_id', $posko->kejadian_id) == $kejadian->kejadian_id ? 'selected' : '' }}>
                                        {{ $kejadian->jenis_bencana }} - {{ $kejadian->lokasi_text }} ({{ $kejadian->tanggal->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('kejadian_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Posko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama"
                                   value="{{ old('nama', $posko->nama) }}"
                                   placeholder="Contoh: Posko Pengungsian Pusat" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="penanggung_jawab">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror"
                                   id="penanggung_jawab" name="penanggung_jawab"
                                   value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}"
                                   placeholder="Nama penanggung jawab" required>
                            @error('penanggung_jawab')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                              id="alamat" name="alamat"
                              rows="3" placeholder="Alamat lengkap posko" required>{{ old('alamat', $posko->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kontak">Kontak <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                   id="kontak" name="kontak"
                                   value="{{ old('kontak', $posko->kontak) }}"
                                   placeholder="Contoh: 081234567890" required>
                            @error('kontak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ✅ FOTO YANG SUDAH ADA -->
                @if (isset($files) && $files->count() > 0)
                    <div class="form-group mt-4">
                        <label class="fw-bold mb-3">Foto Posko yang sudah diupload</label>
                        <div class="row">
                            @foreach ($files as $file)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                            class="img-thumbnail w-100"
                                            style="height: 120px; object-fit: cover;">

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
                            Klik kotak untuk memilih foto yang akan dihapus
                        </div>
                    </div>
                @endif

                <!-- ✅ UPLOAD FOTO BARU -->
                <div class="form-group mt-4">
                    <label class="fw-bold">Upload Foto Posko Baru (Opsional)</label>
                    <small class="text-muted d-block mb-2">
                        Format: JPG, PNG, GIF. Maksimal 2MB per file.
                    </small>

                    <input type="file" name="fotos[]" class="form-control" accept="image/*" multiple>

                    @error('fotos')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    @error('fotos.*')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-lightbulb"></i>
                            Kosongkan jika tidak ingin menambah foto baru.
                        </small>
                    </div>
                </div>

                <!-- ✅ TOMBOL DENGAN STYLE YANG KONSISTEN -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('posko.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Update Data Posko
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
