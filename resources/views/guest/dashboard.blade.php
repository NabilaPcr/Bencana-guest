<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaDesa - Platform Bantuan Bencana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #56a65a;
            --secondary: #4ECDC4;
            --dark: #2e6d38;
            --light: #F7F7F7;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #ffffff;
            color: #2b2b2b;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .navbar-brand {
            font-size: 30px;
            font-weight: 700;
            color: var(--dark) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            padding: 10px 15px !important;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s;
            color: var(--dark);
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: var(--primary);
            color: white !important;
        }

        .btn-login {
            background: var(--primary);
            color: white !important;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #48904d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(86, 166, 90, 0.3);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #a8e0b3, #eaf5ea);
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            color: var(--dark);
            margin-bottom: 20px;
            line-height: 1.2;
            font-weight: 700;
        }

        .hero-content p {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-block;
            font-size: 1.1rem;
            text-decoration: none;
            border: none;
        }

        .btn-primary:hover {
            background-color: #48904d;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(86, 166, 90, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Section Styles */
        .section {
            padding: 80px 0;
        }

        .section h2 {
            text-align: center;
            color: var(--dark);
            font-size: 2.2rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .section p {
            text-align: center;
            color: #444;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 30px;
            font-size: 1.1rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* Event Grid */
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
            padding: 6px 16px;
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

        /* Warga Section */
        .btn-lg {
            padding: 15px 30px;
            font-size: 1.1rem;
        }

        /* Kontak Section */
        .contact-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }

        .contact-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-align: center;
            width: 250px;
            transition: transform 0.3s;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .contact-card h3 {
            color: var(--dark);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .contact-card p {
            color: #555;
            margin-bottom: 0;
            text-align: center;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 0;
        }

        .footer h2 {
            font-size: 20px;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }

        .footer a {
            color: #ddd;
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer a:hover {
            color: var(--primary);
            padding-left: 5px;
            text-decoration: none;
        }

        .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            margin-top: 40px;
        }

        /* Stats Section */
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

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .section h2 {
                font-size: 1.8rem;
            }

            .event-grid {
                grid-template-columns: 1fr;
            }

            .contact-info {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">BinaDesa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kegiatan">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ url ('/warga')}}>Warga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="{{ url ('/users')}}">User</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-login" href="#">Masuk</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Bersama Kita Bisa Membantu Mereka</h1>
                <p>Yuk ikut berkontribusi dalam kegiatan kemanusiaan dan peduli sesama.</p>
                <a href="#" class="btn-primary">Donasi Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">250+</div>
                        <div class="stat-label">Bencana Tertangani</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">15K+</div>
                        <div class="stat-label">Warga Terbantu</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">120+</div>
                        <div class="stat-label">Posko Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">5K+</div>
                        <div class="stat-label">Relawan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <div id="tentang" class="section">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>Kami berfokus membantu masyarakat yang terkena bencana dan membutuhkan. BinaDesa adalah platform yang
                menghubungkan para donatur dengan komunitas yang membutuhkan bantuan di seluruh Indonesia.</p>
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
                        Lihat Data Kejadian
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/posko.jpeg') }}" alt="Posko Bencana">
                    <h3>Posko Bencana</h3>
                    <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
                    <a href="#" class="event-btn">
                        Lihat Posko
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/logistik.jpeg') }}" alt="Logistik Bencana">
                    <h3>Logistik Bencana</h3>
                    <p>Daftar bantuan donasi untuk para korban bencana.</p>
                    <a href="#" class="event-btn">
                        Lihat Logistik
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/distribusi.jpeg') }}" alt="Distribusi Bencana">
                    <h3>Distribusi Bencana</h3>
                    <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
                    <a href="#" class="event-btn">
                        Lihat Distribusi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Warga -->
    <div id="warga" class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-4">
                    <h2>Laporan warga yang terdampak oleh bencana!</h2>
                    <p>Silakan isi form berikut untuk mengisi informasi warga.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="d-grid">
                        <a href="{{ url('/warga') }}" class="btn btn-primary btn-lg py-3">
                            <i class="fas fa-clipboard-list me-2"></i>
                            📌 Isi Form Laporan Warga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <div id="kontak" class="section bg-light">
        <div class="container">
            <h2>Kontak Kami</h2>
            <p>Jika Anda memiliki pertanyaan atau ingin berkolaborasi dengan kami, jangan ragu untuk menghubungi tim
                BinaDesa.</p>

            <div class="contact-info">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Alamat</h3>
                    <p>Jakarta, Indonesia</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Telepon</h3>
                    <p>+62 123 456 789</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>info@binadesa.id</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h2>BinaDesa</h2>
                    <p>Platform bantuan bencana yang menghubungkan donatur dengan komunitas yang membutuhkan di seluruh
                        Indonesia.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h2>Tautan Cepat</h2>
                    <a href="#tentang">Tentang Kami</a>
                    <a href="#kegiatan">Kegiatan</a>
                    <a href="#warga">Data Warga</a>
                    <a href="#kontak">Kontak</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h2>Layanan</h2>
                    <a href="#">Donasi</a>
                    <a href="#">Relawan</a>
                    <a href="#">Posko Bencana</a>
                    <a href="{{ url('/warga') }}">Laporan Bencana</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h2>Media Sosial</h2>
                    <a href="#"><i class="fab fa-facebook me-2"></i> Facebook</a>
                    <a href="#"><i class="fab fa-instagram me-2"></i> Instagram</a>
                    <a href="#"><i class="fab fa-twitter me-2"></i> Twitter</a>
                    <a href="#"><i class="fab fa-youtube me-2"></i> YouTube</a>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; 2024 BinaDesa. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar active state update on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.section');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>
