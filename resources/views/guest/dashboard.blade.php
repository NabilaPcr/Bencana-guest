<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SiDa Siaga Desa</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #56a65a;
            --secondary: #4ECDC4;
            --dark: #2e6d38;
            --light: #F7F7F7;
            --accent: #f39c12;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --gray: #6c757d;
        }

        /* ===== RESET & BASE ===== */
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section {
            padding: 80px 0;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* ===== HEADER/NAVBAR STYLES ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
        }

        /* Logo */
        .logo-horizontal {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .logo-horizontal:hover {
            transform: translateY(-2px);
        }

        .logo-icon-container {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
            transition: all 0.3s ease;
        }

        .logo-horizontal:hover .logo-icon-container {
            transform: rotate(-5deg) scale(1.05);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        }

        .logo-icon-container i {
            font-size: 22px;
            color: white;
        }

        .logo-text-container {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .logo-main {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.5px;
        }

        .logo-accent {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-top: -2px;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 15px;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .nav-links>li {
            position: relative;
        }

        .nav-links a {
            font-weight: 600;
            color: var(--dark);
            transition: all 0.3s;
            padding: 10px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 1rem;
        }

        .nav-links a i:first-child {
            font-size: 16px;
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }

        .nav-links a:hover {
            background: linear-gradient(135deg, var(--primary), #4a9a4e);
            color: white !important;
            box-shadow: 0 4px 12px rgba(86, 166, 90, 0.3);
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown-toggle .fa-chevron-down {
            font-size: 0.8rem;
            transition: transform 0.3s ease;
            margin-left: 3px;
        }

        .dropdown:hover .dropdown-toggle .fa-chevron-down {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1002;
            padding: 10px 0;
            margin-top: 8px;
            border: 1px solid rgba(86, 166, 90, 0.1);
            list-style: none;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu li {
            list-style: none;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 2px 10px;
        }

        .dropdown-menu a i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary);
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white !important;
            transform: translateX(5px);
        }

        .dropdown-menu a:hover i {
            color: white;
        }

        /* Login/Logout Button */
        .btn-login,
        .btn-logout {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white !important;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-login:hover,
        .btn-logout:hover {
            background: linear-gradient(135deg, #48904d, #255d2a);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
            color: white !important;
        }

        /* ===== SLIDESHOW STYLES ===== */
        .hero-section {
            position: relative;
            height: 600px;
            overflow: hidden;
            margin-top: 0;
        }

        .slideshow-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .mySlides {
            display: none;
            width: 100%;
            height: 100%;
        }

        .mySlides img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: 0.4
            }

            to {
                opacity: 1
            }
        }

        .dots-container {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 3;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .dot:hover,
        .dot.active {
            background-color: white;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2;
            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            color: white;
            position: relative;
            z-index: 3;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            font-size: 1.1rem;
            text-decoration: none;
            border: none;
        }

        .btn-primary:hover {
            background-color: #48904d;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
            color: white;
        }

        /* ===== STATS SECTION ===== */
        .stats-section {
            background: linear-gradient(135deg, var(--primary), var(--dark));
            color: white;
            padding: 60px 0;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* ===== TENTANG KAMI ===== */
        .contact-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .text-center h3 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .text-center p {
            color: #555;
        }

        /* ===== KEGIATAN KAMI ===== */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .event-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card h3 {
            padding: 20px 20px 10px;
            color: var(--dark);
            font-size: 1.4rem;
            font-weight: 600;
        }

        .event-card p {
            padding: 0 20px 15px;
            color: #555;
            text-align: left;
            font-size: 1rem;
            flex: 1;
        }

        .event-btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0 20px 20px;
            text-align: center;
            width: auto;
            font-size: 0.85rem;
            min-width: 120px;
        }

        .event-btn:hover {
            background: #48904d;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(86, 166, 90, 0.3);
            color: white;
            text-decoration: none;
        }

        /* ===== IDENTITAS PENGEMBANG ===== */
        .developer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .developer-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
            text-align: center;
            border: 1px solid #e9ecef;
        }

        .developer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .developer-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--dark));
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }

        .developer-info h3 {
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 1.4rem;
        }

        .developer-info .role {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .developer-info .description {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .developer-skills {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .developer-skills .skill {
            background: var(--light);
            color: var(--dark);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-view-more {
            display: inline-flex;
            align-items: center;
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-view-more:hover {
            background: #48904d;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(86, 166, 90, 0.3);
            color: white;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0 20px;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--primary);
            display: inline-block;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: #ddd;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            background: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #aaa;
        }

        /* ===== WHATSAPP FLOAT ===== */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 25px;
            right: 25px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .whatsapp-float i {
            margin-top: 15px;
        }

        .whatsapp-float:hover {
            background-color: #1ebe57;
            transform: scale(1.1);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .nav-links {
                gap: 10px;
            }

            .nav-links a {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .nav-links {
                flex-direction: column;
                gap: 8px;
                width: 100%;
                align-items: stretch;
            }

            .nav-links a,
            .btn-login,
            .btn-logout {
                justify-content: flex-start;
                padding: 12px 20px;
            }

            .dropdown-menu {
                position: static !important;
                box-shadow: none;
                border: 1px solid rgba(86, 166, 90, 0.2);
                margin: 5px 0 !important;
                background: #f9fff9;
                width: 100%;
                opacity: 1 !important;
                visibility: visible !important;
                transform: none !important;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown:hover .dropdown-menu {
                max-height: 300px;
                padding: 10px 0;
            }

            .dropdown-menu a {
                margin: 2px 15px;
                padding: 10px 15px 10px 30px;
            }

            .btn-login,
            .btn-logout {
                margin-top: 10px;
                justify-content: center;
            }

            .hero-section {
                height: 500px;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .developer-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .logo-icon-container {
                width: 40px;
                height: 40px;
            }

            .logo-icon-container i {
                font-size: 20px;
            }

            .logo-main {
                font-size: 20px;
            }

            .logo-accent {
                font-size: 16px;
            }

            .navbar {
                padding: 10px 15px;
            }

            .hero-section {
                height: 400px;
            }

            .hero-content h1 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .developer-card {
                padding: 20px;
            }

            .event-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- START Navbar -->
  <header>
    <nav class="navbar">
        <!-- Logo Horizontal -->
        <a href="/" class="logo-horizontal">
            <div class="logo-icon-container">
                <i class="fas fa-hands-helping"></i>
            </div>
            <div class="logo-text-container">
                <span class="logo-main">SiDa</span>
                <span class="logo-accent">Siaga Desa</span>
            </div>
        </a>

        <ul class="nav-links">
            <li>
                <a href="/dashboard">
                    <i class="fas fa-home me-2"></i> Beranda
                </a>
            </li>

            <!-- Dropdown Kegiatan -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-alt me-2"></i>Kegiatan
                    {{-- <i class="fas fa-chevron-down ms-2 small"></i> --}}
                </a>
                <ul class="dropdown-menu">
                    <!-- Kejadian Bencana -->
                    <li>
                        <a class="dropdown-item" href="/kejadian">
                            <i class="fas fa-exclamation-triangle me-2 "></i>Kejadian Bencana
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>
                        <a class="dropdown-item" href="/posko">
                            <i class="fas fa-hospital-alt me-2 "></i>Posko Bantuan
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Donasi -->
                    <li>
                        <a class="dropdown-item" href="/donasi">
                            <i class="fas fa-hand-holding-heart me-2 "></i>Donasi
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Logistik -->
                    <li>
                        <a class="dropdown-item" href="/logistik">
                            <i class="fas fa-box me-2 "></i>Logistik
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Distribusi -->
                    <li>
                        <a class="dropdown-item" href="/distribusi">
                            <i class="fas fa-truck-loading me-2 "></i>Distribusi
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </li>

            <!-- Data Warga -->
            <li>
                <a href="/warga">
                    <i class="fas fa-users me-2"></i> Data Warga
                </a>
            </li>

            <!-- Pengguna -->
            <li>
                <a href="/users">
                    <i class="fas fa-user-cog me-2"></i> Pengguna
                </a>
            </li>

            <!-- Tombol Masuk/Logout -->
            @if (auth()->check())
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-login btn-logout">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ url('/auth') }}" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span>Masuk</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</header>
    {{-- END NAVBAR  --}}

    <!-- Main Content-->
    <section class="hero-section">
        <div class="slideshow-container">
            <!-- Slide 1 -->
            <div class="mySlides fade">
                <img src="{{ asset('assets/img/about.jpg') }}" alt="Slide 1">
            </div>
            <!-- Slide 2 -->
            <div class="mySlides fade">
                <img src="{{ asset('assets/img/blog-1.jpg') }}" alt="Slide 2">
            </div>
            <!-- Slide 3 -->
            <div class="mySlides fade">
                <img src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Slide 3">
            </div>

            <!-- Navigation dots -->
            <div class="dots-container">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>

        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1>Selamat Datang di SiDa</h1>
                    <p>Sistem Informasi Siaga Desa untuk Menanggulangi Bencana dan Membantu Sesama</p>
                    <div class="hero-buttons">
                        <a href="{{ url('/donasi') }}" class="btn-primary">
                            <i class="fas fa-donate me-2"></i> Donasi Sekarang
                        </a>

                        <a href="{{ url('/warga/create') }}" class="btn-primary">
                            <i class="fas fa-clipboard-list me-2"></i> Isi Form Laporan Warga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Tentang Kami -->
    <div id="tentang" class="section">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p> Siaga Desa adalah sebuah platform digital yang didedikasikan untuk memperkuat ketangguhan masyarakat
                pedesaan dalam menghadapi bencana. Kami memahami bahwa desa sering kali memiliki akses terbatas terhadap
                informasi dan koordinasi bantuan ketika bencana terjadi. Melalui teknologi yang sederhana dan mudah
                diakses, Siaga Desa hadir untuk menjadi teman siaga bagi setiap warga.</p>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="contact-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3>Bantuan Cepat</h3>
                        <p>Memberikan bantuan dengan respon cepat kepada korban bencana</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="contact-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3>Transparan</h3>
                        <p>Setiap donasi dan bantuan dapat dilacak dengan sistem yang transparan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <div class="contact-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Kolaboratif</h3>
                        <p>Bekerja sama dengan berbagai pihak untuk bantuan yang maksimal</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ url('/tentang') }}" class="btn-view-more">
                        <i class="fas fa-users me-2"></i> Lihat Selengkapnya!
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Kegiatan Kami -->
    <div id="kegiatan" class="section bg-light">
        <div class="container">
            <h2>Kegiatan Kami</h2>
            <div class="event-grid">
                <div class="event-card">
                    <img src="{{ asset('assets/img/kejadian.jpeg') }}" alt="Kejadian Bencana">
                    <h3>Kejadian Bencana</h3>
                    <p>Bencana yang terjadi pada setiap daerah.</p>
                    <a href="{{ url('/kejadian') }}" class="event-btn">
                        <i class="fas fa-eye me-1"></i> Lihat Data
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/posko.jpeg') }}" alt="Posko Bencana">
                    <h3>Posko Bencana</h3>
                    <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
                    <a href="{{ url('/posko') }}" class="event-btn">
                        <i class="fas fa-eye me-1"></i> Lihat Posko
                    </a>
                </div>
                <!-- Logistik Bencana (BARU) -->
                <div class="event-card">
                    <img src="{{ asset('assets/img/logistik.jpeg') }}" alt="Logistik Bencana">
                    <h3>Logistik Bencana</h3>
                    <p>Data barang dan persediaan logistik untuk penanganan bencana.</p>
                    <a href="{{ url('/logistik') }}" class="event-btn">
                        <i class="fas fa-eye me-1"></i> Lihat Logistik
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/distribusi.jpeg') }}" alt="Distribusi Bencana">
                    <h3>Distribusi Bencana</h3>
                    <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
                    <a href="{{ url('/distribusi') }}" class="event-btn">
                        <i class="fas fa-eye me-1"></i> Lihat Distribusi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Identitas Pengembang -->
    <div id="pengembang" class="section">
        <div class="container">
            <h2>Identitas Pengembang</h2>
            <p>Tim pengembang yang berdedikasi menciptakan sistem SiDa untuk membantu masyarakat.</p>

            <div class="developer-grid">
                <div class="developer-card">
                    <div class="developer-avatar">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="developer-info">
                        <h3>Nabila Azzahra</h3>
                        <p class="role">Full Stack Developer</p>
                        <p class="description">Bertanggung jawab atas pengembangan sistem secara keseluruhan.</p>
                        <div class="developer-skills">
                            <span class="skill">Laravel</span>
                            <span class="skill">MySQL</span>
                            <span class="skill">Bootstrap</span>
                            <div class="text-center mt-4">
                                <a href="{{ url('/developer') }}" class="btn-view-more">
                                    <i class="fas fa-users me-2"></i> Lihat Selengkapnya!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

        {{-- END MAIN CONTENT  --}}

        <!-- WhatsApp Float -->
        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bertanya." class="whatsapp-float"
            target="_blank" title="Hubungi kami di WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-content">
                    <!-- About Section -->
                    <div class="footer-section">
                        <h3>SiDa - Siaga Desa</h3>
                        <p>Sistem Kebencanaan & Tanggap Darurat untuk melindungi dan membantu masyarakat desa dalam
                            menghadapi bencana.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-section">
                        <h3>Menu Cepat</h3>
                        <ul class="footer-links">
                            <li><a href="/dashboard"><i class="fas fa-home"></i> Beranda</a></li>
                            <li><a href="/kejadian"><i class="fas fa-exclamation-triangle"></i> Kejadian Bencana</a>
                            </li>
                            <li><a href="/posko"><i class="fas fa-hospital-alt"></i> Posko Bantuan</a></li>
                            <li><a href="/donasi"><i class="fas fa-hand-holding-heart"></i> Donasi</a></li>
                            <li><a href="/logistik"><i class="fas fa-box me-2 "></i> Logistik</a></li>
                            <li><a href="/distribusi"><i class="fas fa-truck-loading me-2 "></i> Distribusi</a></li>

                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="footer-section">
                        <h3>Kontak Kami</h3>
                        <ul class="footer-links">
                            <li><a href="tel:+6282384588294"><i class="fas fa-phone"></i> +62 823 8458 8294</a></li>
                            <li><a href="mailto:info@siagadesa.id"><i class="fas fa-envelope"></i> info@siagadesa.id</a>
                            </li>
                            <li><a href="#"><i class="fas fa-map-marker-alt"></i> Rumbai, Pekanbaru</a></li>
                        </ul>
                    </div>
                </div>

                <div class="copyright">
                    <p>&copy; {{ date('Y') }} Siaga Desa. Hak cipta dilindungi.</p>
                </div>
            </div>
        </footer>
        {{-- END FOOTER  --}}

        {{-- START JS  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- END JS  --}}

        <script>
            // Slideshow JavaScript
            document.addEventListener('DOMContentLoaded', function() {
                let slideIndex = 0;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");

                // Show first slide immediately
                if (slides.length > 0) {
                    slides[0].style.display = "block";
                    dots[0].className += " active";
                }

                function showSlides() {
                    // Hide all slides
                    for (let i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                        dots[i].className = dots[i].className.replace(" active", "");
                    }

                    slideIndex++;
                    if (slideIndex > slides.length) {
                        slideIndex = 1;
                    }

                    // Show current slide
                    if (slides[slideIndex - 1]) {
                        slides[slideIndex - 1].style.display = "block";
                    }

                    if (dots[slideIndex - 1]) {
                        dots[slideIndex - 1].className += " active";
                    }

                    // Change slide every 5 seconds
                    setTimeout(showSlides, 5000);
                }

                // Start slideshow after 5 seconds
                setTimeout(showSlides, 5000);

                // Manual navigation function
                window.currentSlide = function(n) {
                    slideIndex = n - 1;
                    showSlides();
                }
            });
        </script>
</body>

</html>
