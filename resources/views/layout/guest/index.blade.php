
@extends('layout.guest.app')

@section('content')
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

    <!-- Tentang Kami -->
    <div id="tentang" class="section">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>Kami berfokus membantu masyarakat yang terkena bencana dan membutuhkan. BinaDesa adalah platform yang
                menghubungkan para donatur dengan komunitas yang membutuhkan bantuan di seluruh Indonesia.</p>
        </div>
    </div>

    <!-- Kegiatan Kami -->
    <div id="kegiatan" class="section bg-light">
        <div class="container">
            <h2>Kegiatan Kami</h2>
            <div class="event-grid">
                <div class="event-card">
                    <img src="{{asset('assets/img/kejadian.jpeg')}}" alt="Kejadian Bencana">
                    <h3>Kejadian Bencana</h3>
                    <p>Bencana yang terjadi pada setiap daerah.</p>
                    <a href="{{route('/kejadian')}}" class="event-btn">
                        Lihat Data Kejadian
                    </a>
                </div>
                <div class="event-card">
                    <img src="{{asset('assets/img/posko.jpeg')}}" alt="Posko Bencana">
                    <h3>Posko Bencana</h3>
                    <p>Lokasi dimana para pengungsi dapat beristirahat dan diobati oleh paramedis.</p>
                </div>
                <div class="event-card">
                    <img src="{{asset('assets/img/logistik.jpeg')}}" alt="Logistik Bencana">
                    <h3>Logistik Bencana</h3>
                    <p>Daftar bantuan donasi untuk para korban bencana.</p>
                </div>
                <div class="event-card">
                    <img src="{{ asset('assets/img/distribusi.jpeg')}}" alt="Distribusi Bencana">
                    <h3>Distribusi Bencana</h3>
                    <p>Pengantaran bantuan donasi untuk para korban bencana.</p>
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
                    <p>silahkan isi form berikut untuk mengisi informasi warga.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="d-grid">
                        <a href="{{route('kejadian.index')}}" class="btn btn-primary btn-lg py-3">
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
        </div>
    </div>
@endsection
