{{-- resources/views/pages/about/index.blade.php --}}
@extends('layout.guest.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center">
                <h1 class="display-4 fw-bold text-primary mb-3">Tentang Siaga Desa</h1>
                <div class="d-flex justify-content-center mb-4">
                    <div class="border-bottom border-primary" style="width: 150px; height: 4px;"></div>
                </div>
                <p class="lead text-muted">Sistem Informasi Kebencanaan Berbasis Komunitas untuk Pedesaan</p>
            </div>
        </div>
    </div>

    <!-- Deskripsi Utama -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 text-center mb-md-0 mb-4">
                            <div class="bg-primary rounded-circle p-4 d-inline-block">
                                <i class="fas fa-hands-helping fa-4x text-white"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-3">Apa itu Siaga Desa?</h2>
                            <p class="fs-5 text-muted">
                                Siaga Desa adalah sebuah platform digital yang didedikasikan untuk memperkuat ketangguhan masyarakat pedesaan dalam menghadapi bencana.
                                Kami memahami bahwa desa sering kali memiliki akses terbatas terhadap informasi dan koordinasi bantuan ketika bencana terjadi.
                                Melalui teknologi yang sederhana dan mudah diakses, Siaga Desa hadir untuk menjadi teman siaga bagi setiap warga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Misi Kami -->
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-center mb-4">Misi Kami</h2>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 border-primary border-2">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-bolt me-2"></i> Mempercepat Laporan Bencana</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Memberikan alat bagi warga untuk melaporkan kejadian bencana secara cepat dan akurat langsung dari lokasi, dilengkapi dengan foto dan detail penting.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 border-success border-2">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-handshake me-2"></i> Memudahkan Koordinasi Bantuan</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Menghubungkan secara transparan data bencana dengan posko penanggulangan, kebutuhan logistik, dan kegiatan distribusi bantuan.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 border-info border-2">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i> Memberdayakan Komunitas</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Membangun database warga desa yang dapat digunakan tidak hanya untuk kondisi darurat (seperti melaporkan warga hilang) tetapi juga untuk program pembangunan desa.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100 border-warning border-2">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0"><i class="fas fa-heart me-2"></i> Menggalang Solidaritas</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Menyediakan kanal donasi yang terpercaya, sehingga bantuan dari para dermawan dapat tepat sasaran dan terdokumentasi dengan baik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Inti -->
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-center mb-4">Fitur Inti Siaga Desa</h2>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Lapor Bencana</h4>
                    <p class="text-muted">
                        Warga dapat langsung melaporkan jenis bencana, lokasi tepat, dan kondisi terkini melalui smartphone.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-warehouse fa-3x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Info Posko & Logistik</h4>
                    <p class="text-muted">
                        Data posko bencana dan stok logistik terupdate tersedia untuk dilihat, meminimalisir tumpang tindih bantuan.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-truck-loading fa-3x text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Manajemen Distribusi</h4>
                    <p class="text-muted">
                        Memantau proses penyaluran bantuan dari gudang hingga ke tangan penerima.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-hand-holding-usd fa-3x text-warning"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Donasi Transparan</h4>
                    <p class="text-muted">
                        Masyarakat dapat berkontribusi melalui platform, dan melihat laporan penggunaan dana.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-user-friends fa-3x text-info"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Data Warga & Orang Hilang</h4>
                    <p class="text-muted">
                        Database warga yang membantu dalam identifikasi dan pencarian warga dalam situasi darurat.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Untuk Siapa Siaga Desa -->
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <h2 class="fw-bold text-center mb-4">Untuk Siapa Siaga Desa?</h2>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-home fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">Masyarakat Desa</h5>
                    <p class="text-muted small">
                        Sebagai pelapor pertama dan penerima manfaat utama.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-hands-helping fa-2x text-success"></i>
                    </div>
                    <h5 class="fw-bold">Relawan & Posko</h5>
                    <p class="text-muted small">
                        Sebagai alat koordinasi dan manajemen data di lapangan.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-landmark fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-bold">Pemerintah & BPBD</h5>
                    <p class="text-muted small">
                        Sebagai sumber data real-time untuk pengambilan keputusan.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-hand-holding-heart fa-2x text-danger"></i>
                    </div>
                    <h5 class="fw-bold">Para Dermawan</h5>
                    <p class="text-muted small">
                        Sebagai jembatan untuk menyalurkan bantuan secara langsung dan transparan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Identitas Pengembang Section -->
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card bg-primary text-white border-0">
            <div class="card-body p-5 text-center">
                <h3 class="fw-bold mb-4">Identitas Pengembang</h3>
                <p class="mb-4">
                    Siaga Desa dikembangkan dengan dedikasi dan komitmen untuk membantu masyarakat pedesaan.
                    Temui pengembang di balik platform ini dan pelajari lebih lanjut tentang visi kami.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('developer.show') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-user-tie me-2"></i> Ketahui Lebih Lanjut!
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<style>
    /* Styling untuk halaman about */
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .border-primary { border-color: var(--primary) !important; }
    .border-success { border-color: var(--dark) !important; }
    .border-info { border-color: #0dcaf0 !important; }
    .border-warning { border-color: #ffc107 !important; }

    .bg-primary { background-color: var(--primary) !important; }
    .bg-success { background-color: var(--dark) !important; }

    .text-primary { color: var(--primary) !important; }

    h1, h2, h3, h4, h5 {
        font-family: 'Quicksand', sans-serif;
    }

    .display-4 {
        font-weight: 700;
        color: var(--dark);
    }

    .lead {
        color: #666;
        font-weight: 500;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.2rem;
        }

        .card-body {
            padding: 1.5rem !important;
        }
    }
</style>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
