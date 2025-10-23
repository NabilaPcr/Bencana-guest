<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kejadian Bencana - BinaDesa</title>
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
            transition: all 0.3s ease;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
            position: relative;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e6d38;
            transition: transform 0.3s ease;
        }

        .navbar .logo:hover {
            transform: scale(1.05);
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
            position: relative;
            padding: 5px 0;
        }

        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #56a65a;
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .nav-links a:hover:after {
            width: 100%;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: #48904d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(86, 166, 90, 0.3);
        }

        .btn-login:after {
            display: none;
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: #2e6d38;
            transition: 0.3s;
            border-radius: 2px;
        }

        /* Active menu item */
        .nav-links a.active {
            color: #56a65a;
            font-weight: 600;
        }

        .nav-links a.active:after {
            width: 100%;
        }

        /* ===== MAIN CONTENT ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            margin-bottom: 50px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            color: #2e6d38;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-align: left;
        }

        .header-text p {
            color: #666;
            font-size: 1.2rem;
            text-align: left;
            margin: 0;
        }

        /* ===== TOMBOL TAMBAH ===== */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #3498db;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        /* ===== KEJADIAN GRID ===== */
        .kejadian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .kejadian-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #56a65a;
        }

        .kejadian-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.12);
        }

        .kejadian-card h3 {
            color: #2e6d38;
            font-size: 1.4rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kejadian-card h3 i {
            color: #56a65a;
        }

        .kejadian-info {
            margin-bottom: 20px;
        }

        .kejadian-info p {
            margin-bottom: 10px;
            color: #555;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .kejadian-info strong {
            color: #333;
            min-width: 80px;
        }

        .kejadian-info i {
            color: #56a65a;
            width: 16px;
            text-align: center;
        }

        /* Status Styles */
        .status-aktif {
            color: #e74c3c;
            font-weight: bold;
            background: #ffeaea;
            padding: 6px 15px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
        }

        .status-selesai {
            color: #27ae60;
            font-weight: bold;
            background: #eafaf1;
            padding: 6px 15px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
        }

        .status-dalam-penanganan {
            color: #f39c12;
            font-weight: bold;
            background: #fef5e7;
            padding: 6px 15px;
            border-radius: 20px;
            display: inline-block;
            font-size: 0.9rem;
        }

        /* ===== CARD ACTIONS ===== */
        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        /* Tombol Detail */
        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #56a65a;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-detail:hover {
            background: #48904d;
            transform: translateY(-2px);
        }

        /* Tombol Edit */
        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f39c12;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-edit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        /* Tombol Hapus */
        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e74c3c;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .delete-form {
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
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
            font-size: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 80%;
                height: calc(100vh - 70px);
                background-color: white;
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 40px;
                gap: 25px;
                transition: left 0.4s ease;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }

            .nav-links.active {
                left: 0;
            }

            .navbar {
                padding: 12px 20px;
            }

            .header-content {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-text h1,
            .header-text p {
                text-align: center;
            }

            .btn-add {
                justify-content: center;
            }

            .header-text h1 {
                font-size: 2rem;
            }

            .header-text p {
                font-size: 1.1rem;
            }

            .kejadian-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .container {
                padding: 20px 15px;
            }

            .card-actions {
                flex-direction: column;
                gap: 10px;
            }

            .action-buttons {
                width: 100%;
                justify-content: space-between;
            }

            .btn-edit,
            .btn-delete {
                flex: 1;
                justify-content: center;
            }
        }

        /* Animation for menu toggle */
        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
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

            <div class="menu-toggle" id="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <ul class="nav-links" id="nav-links">
                <li><a href="/dashboard">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kegiatan">Kegiatan</a></li>
                <li><a href="#kontak">Kontak</a></li>
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
            <div class="header-content">
                <div class="header-text">
                    <h1><i class="fas fa-exclamation-triangle"></i> Data Kejadian Bencana</h1>
                    <p>Informasi terbaru tentang kejadian bencana yang sedang ditangani</p>
                </div>
                <a href="{{ route('kejadian.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Kejadian
                </a>
            </div>
        </div>

        @if($kejadian->count() > 0)
            <div class="kejadian-grid">
                @foreach($kejadian as $item)
                <div class="kejadian-card">
                    <h3><i class="fas fa-bolt"></i> {{ $item->jenis_bencana }}</h3>

                    <div class="kejadian-info">
                        <p>
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Lokasi:</strong> {{ $item->lokasi_text }}
                            @if($item->rt || $item->rw)
                                (RT {{ $item->rt }}/RW {{ $item->rw }})
                            @endif
                        </p>
                        <p>
                            <i class="fas fa-calendar"></i>
                            <strong>Tanggal:</strong> {{ $item->tanggal->format('d M Y') }}
                        </p>
                        <p>
                            <i class="fas fa-fire"></i>
                            <strong>Dampak:</strong> {{ $item->dampak }}
                        </p>
                        <p>
                            <i class="fas fa-info-circle"></i>
                            <strong>Status:</strong>
                            <span class="status-{{ str_replace(' ', '-', $item->status_kejadian) }}">
                                {{ $item->status_kejadian }}
                            </span>
                        </p>
                        @if($item->keterangan)
                        <p>
                            <i class="fas fa-clipboard"></i>
                            <strong>Keterangan:</strong> {{ $item->keterangan }}
                        </p>
                        @endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('kejadian.show', $item->kejadian_id) }}" class="btn-detail">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                        <div class="action-buttons">
                            <a href="{{ route('kejadian.edit', $item->kejadian_id) }}" class="btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('kejadian.destroy', $item->kejadian_id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kejadian ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>Belum Ada Data Kejadian</h3>
                <p>Silakan check kembali nanti untuk informasi terbaru</p>
            </div>
        @endif
    </div>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const navLinks = document.getElementById('nav-links');

            mobileMenu.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                navLinks.classList.toggle('active');
            });

            // Close mobile menu when clicking on a link
            const navItems = document.querySelectorAll('.nav-links a');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    navLinks.classList.remove('active');
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if(window.scrollY > 50) {
                    header.style.padding = '0';
                    header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                } else {
                    header.style.padding = '';
                    header.style.boxShadow = '0 2px 15px rgba(0,0,0,0.08)';
                }
            });
        });
    </script>
</body>
</html>
