@extends('layout.guest.app')
@section('title', 'Edit Posko Bencana')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Posko Bencana</h4>
                    <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posko-bencana.update', $posko->posko_id) }}" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="media">Media</label>
                                    <input type="text" class="form-control @error('media') is-invalid @enderror"
                                           id="media" name="media"
                                           value="{{ old('media', $posko->media) }}"
                                           placeholder="Contoh: Instagram, Facebook, dll">
                                    @error('media')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Posko</label>

                            @if($posko->foto)
                                <div class="mb-2">
                                    <p>Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $posko->foto) }}"
                                         alt="Foto Posko"
                                         style="max-width: 200px; max-height: 200px;"
                                         class="img-thumbnail">
                                    <br>
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                </div>
                            @endif

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror"
                                       id="foto" name="foto" accept="image/*">
                                <label class="custom-file-label" for="foto">
                                    {{ $posko->foto ? 'Ganti file foto...' : 'Pilih file foto...' }}
                                </label>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Format: JPG, PNG, GIF. Maksimal 2MB.
                            </small>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Posko
                            </button>
                            <a href="{{ route('posko-bencana.index') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
