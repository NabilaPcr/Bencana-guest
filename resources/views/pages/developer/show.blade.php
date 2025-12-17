{{-- resources/views/pages/developer/show.blade.php --}}
@extends('layout.guest.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">Identitas Pengembang</h1>
                <div class="d-flex justify-content-center mb-4">
                    <div class="border-bottom border-primary" style="width: 150px; height: 4px;"></div>
                </div>
                <p class="lead text-muted">Profil Pengembang Sistem Siaga Desa</p>
            </div>
        </div>
    </div>

    <!-- Card Identitas Pengembang -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <!-- Foto Pengembang -->
                        <div class="mb-4">
                            <img src="{{ asset('assets/img/Nabila.jpg') }}"
                                 alt="Foto Pengembang"
                                 class="rounded-circle border border-4 border-primary"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        </div>

                        <!-- Nama dan NIM -->
                        <h2 class="fw-bold text-primary">[Nabila Azzahra]</h2>
                        <h4 class="text-muted mb-3">[2457301103]</h4>

                        <!-- Prodi -->
                        <div class="mb-4">
                            <span class="badge bg-primary fs-6 p-2">
                                <i class="fas fa-graduation-cap me-2"></i>
                                [Sistem Informasi]
                            </span>
                        </div>
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-5 text-center">
                        <p class="fs-5">
                            Pengembang utama Sistem Siaga Desa, berdedikasi menciptakan solusi teknologi
                            untuk membantu masyarakat pedesaan dalam menghadapi bencana.
                        </p>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mb-5">
                        <h4 class="fw-bold mb-4 text-center">Hubungi Saya</h4>
                        <div class="d-flex justify-content-center gap-4 flex-wrap">
                            <!-- LinkedIn -->
                            <a href="[LINKEDIN_URL_ANDA]"
                               target="_blank"
                               class="social-icon linkedin">
                                <i class="fab fa-linkedin fa-2x"></i>
                                <span class="d-block mt-2 small">LinkedIn</span>
                            </a>

                            <!-- GitHub -->
                            <a href="[https://github.com/NabilaPcr/Bencana-guest.git]"
                               target="_blank"
                               class="social-icon github">
                                <i class="fab fa-github fa-2x"></i>
                                <span class="d-block mt-2 small">GitHub</span>
                            </a>

                            <!-- Instagram -->
                            <a href="[INSTAGRAM_URL_ANDA]"
                               target="_blank"
                               class="social-icon instagram">
                                <i class="fab fa-instagram fa-2x"></i>
                                <span class="d-block mt-2 small">Instagram</span>
                            </a>

                            <!-- Email -->
                            <a href="mailto:[na.bila.zhr001@gmail.com]"
                               class="social-icon email">
                                <i class="fas fa-envelope fa-2x"></i>
                                <span class="d-block mt-2 small">Email</span>
                            </a>
                        </div>
                    </div>

                    <!-- Skills/Teknologi yang digunakan -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3 text-center">Teknologi yang Digunakan</h4>
                        <div class="d-flex justify-content-center flex-wrap gap-2">
                            <span class="badge bg-primary p-2">Laravel</span>
                            <span class="badge bg-success p-2">Bootstrap 5</span>
                            <span class="badge bg-info p-2">MySQL</span>
                            <span class="badge bg-warning p-2">JavaScript</span>
                            <span class="badge bg-danger p-2">HTML/CSS</span>
                            <span class="badge bg-secondary p-2">Git</span>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="text-center mt-5">
                        <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg me-2">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Tentang Kami
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-home me-2"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling untuk halaman developer */
    .social-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        padding: 15px;
        border-radius: 10px;
        width: 100px;
    }

    .social-icon:hover {
        transform: translateY(-5px);
        text-decoration: none;
    }

    .social-icon.linkedin:hover {
        color: #0A66C2;
        background-color: rgba(10, 102, 194, 0.1);
    }

    .social-icon.github:hover {
        color: #333;
        background-color: rgba(51, 51, 51, 0.1);
    }

    .social-icon.instagram:hover {
        color: #E4405F;
        background-color: rgba(228, 64, 95, 0.1);
    }

    .social-icon.email:hover {
        color: #D44638;
        background-color: rgba(212, 70, 56, 0.1);
    }

    .badge {
        font-size: 0.9rem;
        padding: 8px 15px;
        border-radius: 20px;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .social-icon {
            width: 80px;
            padding: 10px;
        }

        .social-icon i {
            font-size: 1.5rem;
        }
    }
</style>

<!-- Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
