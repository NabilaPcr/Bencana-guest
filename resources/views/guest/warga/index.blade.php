<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - BinaDesa</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            gap: 20px;
        }

        .header-text h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-text p {
            color: #666;
        }

        .btn-add {
            background: #24af5a;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #1e8d4a;
            transform: translateY(-2px);
        }

        /* ===== WARGA GRID ===== */
        .warga-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
        }

        .warga-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-left: 4px solid #56a65a;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .warga-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .warga-card h3 {
            color: #2e6d38;
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .warga-info {
            margin-bottom: 20px;
        }

        .warga-info p {
            margin-bottom: 8px;
            color: #555;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .warga-info strong {
            color: #333;
            min-width: 120px;
        }

        .warga-info i {
            color: #56a65a;
            width: 16px;
            text-align: center;
        }

        /* Status Styles untuk Warga */
        .status-korban {
            background: #ffeaea;
            color: #e74c3c;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-pengungsi {
            background: #eaf7ff;
            color: #3498db;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-relawan {
            background: #f0ffea;
            color: #27ae60;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-warga_normal {
            background: #f8f9fa;
            color: #6c757d;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        /* Health Status untuk Warga */
        .health-sehat { color: #27ae60; }
        .health-luka_ringan { color: #f39c12; }
        .health-luka_berat { color: #e74c3c; }
        .health-meninggal { color: #7f8c8d; }

        /* ===== CARD ACTIONS ===== */
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .card-actions a,
        .card-actions button {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.85rem;
            white-space: nowrap;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .btn-detail {
            background: #56a65a;
            color: white;
        }

        .btn-detail:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #f39c12;
            color: white;
        }

        .btn-edit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .delete-form {
            flex: 1;
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: #999;
            margin-bottom: 10px;
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

            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 1.8rem;
            }

            .btn-add {
                justify-content: center;
            }

            .warga-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .card-actions {
                flex-direction: column;
                gap: 8px;
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
        <div class="page-header">
            <div class="header-text">
                <h1><i class="fas fa-users"></i> Data Warga</h1>
                <p>Data warga terdampak bencana, pengungsi, dan relawan</p>
            </div>
            <a href="{{ route('warga.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah Warga
            </a>
        </div>

        @if($warga->count() > 0)
            <div class="warga-grid">
                @foreach($warga as $item)
                <div class="warga-card">
                    <h3><i class="fas fa-user"></i> {{ $item->nama }}</h3>

                    <div class="warga-info">
                        <p>
                            <i class="fas fa-id-card"></i>
                            <strong>NIK:</strong> {{ $item->no_ktp }}
                        </p>
                        <p>
                            <i class="fas fa-venus-mars"></i>
                            <strong>Jenis Kelamin:</strong> {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Alamat:</strong> {{ $item->alamat }} RT{{ $item->rt }}/RW{{ $item->rw }}
                        </p>
                        <p>
                            <i class="fas fa-bolt"></i>
                            <strong>Status:</strong>
                            <span class="status-{{ $item->status_dampak }}">
                                {{ ucfirst($item->status_dampak) }}
                            </span>
                        </p>
                        <p>
                            <i class="fas fa-heartbeat"></i>
                            <strong>Kesehatan:</strong>
                            <span class="health-{{ $item->status_kesehatan }}">
                                {{ ucfirst(str_replace('_', ' ', $item->status_kesehatan)) }}
                            </span>
                        </p>
                        @if($item->kejadian)
                        <p>
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Kejadian:</strong> {{ $item->kejadian->jenis_bencana }}
                        </p>
                        @endif
                        @if($item->kebutuhan_khusus)
                        <p>
                            <i class="fas fa-info-circle"></i>
                            <strong>Kebutuhan:</strong> {{ $item->kebutuhan_khusus }}
                        </p>
                        @endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('warga.show', $item->warga_id) }}" class="btn-detail">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Data Warga</h3>
                <p>Silakan tambah data warga pertama Anda</p>
            </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>
</body>
</html>
