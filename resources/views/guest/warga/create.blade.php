@extends('layout.guest.app')
@section('content')
     <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('warga.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar Warga
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-user-plus"></i> Form Laporan Warga</h1>
                <p>Laporan warga yang terdampak oleh bencana! Silahkan isi form berikut untuk mengisi informasi warga.</p>
            </div>

            <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                <h3 class="section-title"><i class="fas fa-user-circle"></i> Data Pribadi</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" required
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="form-group">
                        <label for="no_ktp">No KTP *</label>
                        <input type="text" id="no_ktp" name="no_ktp" required
                               placeholder="Masukkan No KTP">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin *</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agama">Agama *</label>
                        <input type="text" id="agama" name="agama" required
                               placeholder="Masukkan agama">
                    </div>
                </div>

                <h3 class="section-title"><i class="fas fa-address-card"></i> Data Kontak & Status</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan *</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" required
                               placeholder="Masukkan pekerjaan">
                    </div>

                    <div class="form-group">
                        <label for="telp">No Telepon *</label>
                        <input type="tel" id="telp" name="telp" required
                               placeholder="Masukkan nomor telepon">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="status_dampak">Status Dampak *</label>
                        <select id="status_dampak" name="status_dampak" required>
                            <option value="">Pilih Status Dampak</option>
                            <option value="korban">Korban</option>
                            <option value="pengungsi">Pengungsi</option>
                            <option value="relawan">Relawan</option>
                            <option value="warga_biasa">Warga Biasa</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status_kesehatan">Status Kesehatan *</label>
                    <select id="status_kesehatan" name="status_kesehatan" required>
                        <option value="">Pilih Status Kesehatan</option>
                        <option value="sehat">Sehat</option>
                        <option value="luka_ringan">Luka Ringan</option>
                        <option value="luka_berat">Luka Berat</option>
                        <option value="meninggal">Meninggal</option>
                    </select>
                </div>

                <h3 class="section-title"><i class="fas fa-home"></i> Alamat</h3>

                <div class="form-group">
                    <label for="alamat">Alamat Lengkap *</label>
                    <textarea id="alamat" name="alamat" required
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="rt">RT *</label>
                        <input type="text" id="rt" name="rt" required
                               placeholder="Masukkan RT">
                    </div>

                    <div class="form-group">
                        <label for="rw">RW *</label>
                        <input type="text" id="rw" name="rw" required
                               placeholder="Masukkan RW">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Kirim Laporan Warga
                </button>
            </form>
        </div>
    </div>
@endsection
