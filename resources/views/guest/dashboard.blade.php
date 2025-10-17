{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guest | CharityCare</title>

    <!-- CSS utama -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== NAVBAR ===== */
        header {
            background-color: #eaf5ea;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1100px;
            margin: auto;
            padding: 0 20px;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2e6d38;
        }

        .navbar .logo span {
            color: #7ac27b;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 25px;
        }

        .nav-links a {
            font-weight: 500;
            color: #2e6d38;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-login:hover {
            background: #48904d;
        }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(135deg, #a8e0b3, #eaf5ea);
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 2.4rem;
            color: #2e6d38;
            margin-bottom: 15px;
        }

        .hero p {
            color: #333;
            margin-bottom: 25px;
        }

        .btn-primary {
            background-color: #56a65a;
            color: white;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-primary:hover {
            background-color: #48904d;
        }

        /* ===== SECTIONS ===== */
        section {
            padding: 60px 20px;
            max-width: 1100px;
            margin: auto;
        }

        section h2 {
            text-align: center;
            color: #2e6d38;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        section p {
            text-align: center;
            color: #444;
            line-height: 1.6;
        }

        /* ===== KEGIATAN ===== */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .event-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .event-card h3 {
            padding: 15px 20px 5px;
            color: #2e6d38;
        }

        .event-card p {
            padding: 0 20px 20px;
            color: #555;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #eaf5ea;
            text-align: center;
            padding: 25px 0;
            color: #2e6d38;
            margin-top: 40px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <nav class="navbar">
            <a href="/" class="logo">Bina<span>Desa</span></a>
            <ul class="nav-links">
                <li><a href="/">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kegiatan">Kegiatan</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="{{ url('/formLogin') }}" class="btn-login">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <h1>Bersama Kita Bisa Membantu Mereka</h1>
        <p>Yuk ikut berkontribusi dalam kegiatan kemanusiaan dan peduli sesama.</p>
        <a href="#" class="btn-primary">Donasi Sekarang</a>
    </section>

    <!-- TENTANG -->
    <section id="tentang">
        <h2>Tentang Kami</h2>
        <p>Kami berfokus membantu masyarakat yang terkena bencana dan membutuhkan.</p>
    </section>

    <!-- KEGIATAN -->
    <section id="kegiatan">
        <h2>Kegiatan Kami</h2>
        <div class="event-grid">
            <div class="event-card">
                <img src="{{ asset('assets/img/posko.jpeg') }}" alt="Posko Bencana">
                <h3>Posko Bencana</h3>
                <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/donasi.jpeg') }}" alt="Donasi Bencana">
                <h3>Donasi Bencana</h3>
                <p>Program pengumpulan dana untuk membantu para korban memenuhi kebutuhannya pasca bencana.</p>
            </div>
             <div class="event-card">
                <img src="{{ asset('assets/img/logistik.jpeg') }}" alt="Logistik Bencana">
                <h3>Logistik Bencana</h3>
                <p>Daftar bantuan donasi untuk para korban bencana.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/distribusi.jpeg') }}" alt="Distribusi Bencana">
                <h3>Distribusi Bencana</h3>
                <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
            </div>
        </div>
    </section>


    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman .</p>
    </footer>
</body>
</html> --}}
{{-- KODINGAN BARU!! --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaDesa - Bersama Membantu Sesama</title>

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
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

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(135deg, #a8e0b3, #eaf5ea);
            text-align: center;
            padding: 120px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 2.8rem;
            color: #2e6d38;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero p {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            background-color: #56a65a;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-block;
            font-size: 1.1rem;
            box-shadow: 0 4px 10px rgba(86, 166, 90, 0.3);
        }

        .btn-primary:hover {
            background-color: #48904d;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
        }

        /* ===== SECTIONS ===== */
        section {
            padding: 80px 20px;
            max-width: 1100px;
            margin: auto;
        }

        section h2 {
            text-align: center;
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 20px;
        }

        section p {
            text-align: center;
            color: #444;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        /* ===== KEGIATAN ===== */
        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .event-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.12);
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card h3 {
            padding: 20px 20px 10px;
            color: #2e6d38;
            font-size: 1.4rem;
        }

        .event-card p {
            padding: 0 20px 20px;
            color: #555;
            text-align: left;
            font-size: 1rem;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #2e6d38;
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 40px;
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

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            section h2 {
                font-size: 1.8rem;
            }

            .event-grid {
                grid-template-columns: 1fr;
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
                <li><a href="/" class="active">Beranda</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kegiatan">Kegiatan</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="{{ url('/formLogin') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a></li>
            </ul>
        </nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bersama Kita Bisa Membantu Mereka</h1>
            <p>Yuk ikut berkontribusi dalam kegiatan kemanusiaan dan peduli sesama.</p>
            <a href="#" class="btn-primary">Donasi Sekarang</a>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang">
        <h2>Tentang Kami</h2>
        <p>Kami berfokus membantu masyarakat yang terkena bencana dan membutuhkan. BinaDesa adalah platform yang menghubungkan para donatur dengan komunitas yang membutuhkan bantuan di seluruh Indonesia.</p>
    </section>

    <!-- KEGIATAN -->
    <section id="kegiatan">
        <h2>Kegiatan Kami</h2>
        <div class="event-grid">
            <div class="event-card">
                <img src="{{ asset('assets/img/posko.jpg') }}" alt="Posko Bencana">
                <h3>Posko Bencana</h3>
                <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/donasi.jpg') }}" alt="Donasi Bencana">
                <h3>Donasi Bencana</h3>
                <p>Program pengumpulan dana untuk membantu para korban memenuhi kebutuhannya pasca bencana.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/logistik.jpg') }}" alt="Logistik Bencana">
                <h3>Logistik Bencana</h3>
                <p>Daftar bantuan donasi untuk para korban bencana.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/distribusi.jpg') }}" alt="Distribusi Bencana">
                <h3>Distribusi Bencana</h3>
                <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak">
        <h2>Kontak Kami</h2>
        <p>Jika Anda memiliki pertanyaan atau ingin berkolaborasi dengan kami, jangan ragu untuk menghubungi tim BinaDesa.</p>
    </section>

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

                    // Update active menu item
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
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
