@extends('layout.guest.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('warga.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data Warga
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit Data Warga</h1>
                <p>Perbarui data warga berikut</p>
            </div>

            <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="no_ktp">Nomor KTP *</label>
                    <input type="text" id="no_ktp" name="no_ktp" required
                           value="{{ old('no_ktp', $warga->no_ktp) }}"
                           placeholder="Masukkan nomor KTP">
                </div>

                <div class="form-group">
                    <label for="nama">Nama Lengkap *</label>
                    <input type="text" id="nama" name="nama" required
                           value="{{ old('nama', $warga->nama) }}"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin *</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama *</label>
                        <input type="text" id="agama" name="agama" required
                               value="{{ old('agama', $warga->agama) }}"
                               placeholder="Contoh: Islam, Kristen, dll">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan *</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" required
                               value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                               placeholder="Contoh: Wiraswasta, PNS, dll">
                    </div>

                    <div class="form-group">
                        <label for="telp">Nomor Telepon *</label>
                        <input type="text" id="telp" name="telp" required
                               value="{{ old('telp', $warga->telp) }}"
                               placeholder="Contoh: 081234567890">
                    </div>
                </div>

                {{-- <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $warga->email) }}"
                           placeholder="Contoh: contoh@email.com">
                </div> --}}

                <div class="form-group">
                    <label for="alamat">Alamat Lengkap *</label>
                    <textarea id="alamat" name="alamat" required
                              placeholder="Masukkan alamat lengkap">{{ old('alamat', $warga->alamat) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="rt">RT *</label>
                        <input type="text" id="rt" name="rt" required
                               value="{{ old('rt', $warga->rt) }}"
                               placeholder="Contoh: 05">
                    </div>

                    <div class="form-group">
                        <label for="rw">RW *</label>
                        <input type="text" id="rw" name="rw" required
                               value="{{ old('rw', $warga->rw) }}"
                               placeholder="Contoh: 02">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="status_dampak">Status Dampak *</label>
                        <select id="status_dampak" name="status_dampak" required>
                            <option value="">Pilih Status</option>
                            <option value="korban" {{ old('status_dampak', $warga->status_dampak) == 'korban' ? 'selected' : '' }}>Korban</option>
                            <option value="pengungsi" {{ old('status_dampak', $warga->status_dampak) == 'pengungsi' ? 'selected' : '' }}>Pengungsi</option>
                            <option value="relawan" {{ old('status_dampak', $warga->status_dampak) == 'relawan' ? 'selected' : '' }}>Relawan</option>
                            <option value="warga_normal" {{ old('status_dampak', $warga->status_dampak) == 'warga_normal' ? 'selected' : '' }}>Warga Normal</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status_kesehatan">Status Kesehatan *</label>
                        <select id="status_kesehatan" name="status_kesehatan" required>
                            <option value="">Pilih Status</option>
                            <option value="sehat" {{ old('status_kesehatan', $warga->status_kesehatan) == 'sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="luka_ringan" {{ old('status_kesehatan', $warga->status_kesehatan) == 'luka_ringan' ? 'selected' : '' }}>Luka Ringan</option>
                            <option value="luka_berat" {{ old('status_kesehatan', $warga->status_kesehatan) == 'luka_berat' ? 'selected' : '' }}>Luka Berat</option>
                            <option value="meninggal" {{ old('status_kesehatan', $warga->status_kesehatan) == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                    <textarea id="kebutuhan_khusus" name="kebutuhan_khusus"
                              placeholder="Contoh: Butuh obat diabetes, makanan khusus, dll">{{ old('kebutuhan_khusus', $warga->kebutuhan_khusus) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan Tambahan</label>
                    <textarea id="keterangan" name="keterangan"
                              placeholder="Informasi tambahan tentang warga">{{ old('keterangan', $warga->keterangan) }}</textarea>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('warga.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit btn-submit-full">
                        <i class="fas fa-save"></i> Update Data Warga
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
