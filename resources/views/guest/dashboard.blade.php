@extends('layout.dashboard.app')
@section('content')
    <!-- Main Content-->
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
                    <p>+62 852-7838-6609</p>
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
     <a href="https://wa.me/6282384588294?text=Halo%20Admin,%20saya%20ingin%20bertanya." class="whatsapp-float"
        target="_blank" title="Hubungi kami di WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    {{-- END MAIN CONTENT  --}}
    @endsection

