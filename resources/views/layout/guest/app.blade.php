 <!DOCTYPE html>
 <html lang="id">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>BinaDesa - Bersama Membantu Sesama</title>

     {{-- START CSS  --}}
     @include('layout.guest.css')
     {{-- END CSS --}}
 </head>

 <body>
     <!-- START NAVBAR -->
     @include('layout.guest.navbar')
     <!-- END NAVBAR -->

     {{-- START CONTENT --}}
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
         <p>Kami berfokus membantu masyarakat yang terkena bencana dan membutuhkan. BinaDesa adalah platform yang
             menghubungkan para donatur dengan komunitas yang membutuhkan bantuan di seluruh Indonesia.</p>
     </section>

     <!-- KEGIATAN -->
     <section id="kegiatan">
         <h2>Kegiatan Kami</h2>
         <div class="event-grid">
             <div class="event-card">
                 <img src="{{ asset('assets/img/kejadian.jpeg') }}" alt="Donasi Bencana">
                 <h3>Kejadian Bencana</h3>
                 <p>Bencana yang terjadi pada setiap daerah.</p>
                 <a href="{{ route('kejadian.index') }}" class="event-btn">
                     Lihat Data Kejadian
                 </a>
             </div>
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

     <!-- Warga -->
     <section id="warga" class="py-5 bg-light">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-12 text-center mb-4">
                     <h2 class="fw-bold text-dark">Laporan warga yang terdampak oleh bencana!</h2>
                     <p class="lead text-muted">silahkan isi form berikut untuk mengisi informasi warga.</p>
                 </div>
             </div>
             <div class="row justify-content-center">
                 <div class="col-md-6 col-lg-4 text-center">
                     <div class="d-grid">
                         <a href="{{ route('warga.index') }}" class="btn btn-primary btn-lg py-3 fw-bold">
                             <i class="fas fa-clipboard-list me-2"></i>
                             📌 Isi Form Laporan Warga
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <!-- KONTAK -->
     <section id="kontak">
         <h2>Kontak Kami</h2>
         <p>Jika Anda memiliki pertanyaan atau ingin berkolaborasi dengan kami, jangan ragu untuk menghubungi tim
             BinaDesa.</p>
     </section>
     {{-- END CONTENT --}}

     {{-- START FOOTER --}}
     @include('layout.guest.footer')
     {{-- END FOOTER --}}

     {{-- START JS --}}
     @include('layout.guest.js')
     {{-- END JS --}}
 </body>

 </html>
