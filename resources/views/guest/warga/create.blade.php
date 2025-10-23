<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Laporan Warga - BinaDesa</title>
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

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: #2b2b2b;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #2e6d38;
        }

        .btn-login {
            background: #2e6d38;
            color: white !important;
            padding: 8px 20px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #245a2d;
        }

        /* ===== MAIN CONTENT ===== */
        .container {
            max-width: 900px;
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

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
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
            background: #56a65a;
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
        }

        .btn-submit:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        .section-title {
            color: #2e6d38;
            font-size: 1.3rem;
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
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

            .nav-links {
                gap: 15px;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
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

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>

    <script>
        // Set max date untuk tanggal lahir (hari ini)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_lahir').max = today;
    </script>
</body>
</html>
