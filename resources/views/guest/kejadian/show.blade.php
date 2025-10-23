<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kejadian - BinaDesa</title>
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
            max-width: 1000px;
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

        .detail-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-left: 6px solid #56a65a;
        }

        .detail-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }

        .detail-header h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .status-aktif {
            background: #ffeaea;
            color: #e74c3c;
        }

        .status-selesai {
            background: #eafaf1;
            color: #27ae60;
        }

        .status-dalam-penanganan {
            background: #fef5e7;
            color: #f39c12;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-group h3 {
            color: #2e6d38;
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-group h3 i {
            color: #56a65a;
            width: 20px;
        }

        .info-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #56a65a;
        }

        .keterangan-box {
            background: #fff9e6;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #f39c12;
            margin-top: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #56a65a;
            color: white;
        }

        .btn-primary:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
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

            .detail-card {
                padding: 25px;
            }

            .detail-header h1 {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 10px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
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
                <li><a href="/">Beranda</a></li>
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

            <div class="action-buttons">
                <a href="{{ route('kejadian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Lihat Semua Kejadian
                </a>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-donate"></i> Donasi Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>
</body>
</html>
