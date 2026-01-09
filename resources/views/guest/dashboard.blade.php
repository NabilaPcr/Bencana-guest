@extends('layout.dashboard.app')
@section('content')
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
         <!-- WhatsApp Float -->
        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bertanya." class="whatsapp-float"
            target="_blank" title="Hubungi kami di WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>

        {{-- END MAIN CONTENT  --}}

@endsection
