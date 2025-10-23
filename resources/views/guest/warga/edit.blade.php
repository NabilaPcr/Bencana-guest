<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga - BinaDesa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & FONT ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7fbf7;
            color: #2b2b2b;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== NAVBAR ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e6d38;
        }

        .navbar .logo i {
            font-size: 2rem;
            color: #56a65a;
        }

        .navbar .logo span {
            color: #7ac27b;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: #2e6d38;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #48904d;
        }

        /* ===== MAIN CONTENT ===== */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #56a65a;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .back-link:hover {
            color: #48904d;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-left: 6px solid #f39c12;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2e6d38;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #56a65a;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: #f39c12;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-submit-full {
            flex: 2;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #2e6d38;
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 60px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .form-card {
                padding: 25px;
            }

            .form-header h1 {
                font-size: 1.8rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <nav class="navbar">
            <a href="/" class="logo">
                <i class="fas fa-hands-helping"></i>
                Bina<span>Desa</span>
            </a>

            <ul class="nav-links">
                <li><a href="/dashboard">Beranda</a></li>
                <li><a href="/kejadian">Kejadian Bencana</a></li>
                <li><a href="/warga">Data Warga</a></li>
                <li><a href="{{ url('/auth') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a></li>
            </ul>
        </nav>
    </header>

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

                {{-- <div class="form-group">
                    <label for="kejadian_id">Kejadian Bencana (Jika Terdampak)</label>
                    <select id="kejadian_id" name="kejadian_id">
                        <option value="">Pilih Kejadian (Opsional)</option>
                        @foreach($kejadian as $k)
                            <option value="{{ $k->kejadian_id }}" {{ old('kejadian_id', $warga->kejadian_id) == $k->kejadian_id ? 'selected' : '' }}>
                                {{ $k->jenis_bencana }} - {{ $k->lokasi_text }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

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

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>
</body>
</html>
