<!DOCTYPE html>
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
                <img src="{{ asset('assets/img/pedesaan.jpeg') }}" alt="Posko Bencana">
                <h3>Posko Bencana</h3>
                <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/event2.jpg') }}" alt="Donasi Bencana">
                <h3>Donasi Bencana</h3>
                <p>Program pengumpulan dana untuk membantu para korban memenuhi kebutuhannya pasca bencana.</p>
            </div>
             <div class="event-card">
                <img src="{{ asset('assets/img/event2.jpg') }}" alt="Donasi Bencana">
                <h3>Logistik Bencana</h3>
                <p>Daftar bantuan donasi untuk para korban bencana.</p>
            </div>
            <div class="event-card">
                <img src="{{ asset('assets/img/event2.jpg') }}" alt="Donasi Bencana">
                <h3>Distribusi Bencana</h3>
                <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} CharityCare. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
