<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaDesa - Admin Dashboard</title>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #56a65a;
            --secondary: #4ECDC4;
            --dark: #2e6d38;
            --light: #F7F7F7;
            --success: #28a745;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f8f9fa;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: var(--dark);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu a {
            padding: 12px 20px;
            display: block;
            color: #ddd;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid var(--primary);
        }

        .sidebar-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .top-navbar {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid #e9ecef;
        }

        .content-area {
            padding: 20px;
        }

        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .card-header {
            padding: 15px 20px;
            background: var(--dark);
            color: white;
            border-bottom: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        /* BinaDesa Styles */
        .btn-custom {
            background: var(--primary);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-custom:hover {
            background: #48904d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(86, 166, 90, 0.3);
        }

        .section-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-header p {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .section-header h2 {
            font-weight: 700;
            color: var(--dark);
        }

        /* Dashboard Stats */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon i {
            font-size: 24px;
            color: white;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }

        /* Table Styles */
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid var(--primary);
            color: var(--dark);
            font-weight: 600;
        }

        .badge-success {
            background-color: var(--primary);
        }

        /* Quick Actions */
        .quick-actions .btn {
            margin: 5px;
            padding: 12px 20px;
            font-weight: 500;
        }

        /* Toggle for mobile */
        #sidebarToggle {
            display: none;
            background: var(--primary);
            border: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.active {
                margin-left: 250px;
            }

            #sidebarToggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-hands-helping"></i> BinaDesa</h3>
                <small class="text-muted">Admin Panel</small>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ url('/kejadian') }}"><i class="fas fa-exclamation-triangle"></i> Data Kejadian</a></li>
                <li><a href="{{ url('/warga') }}"><i class="fas fa-users"></i> Data Warga</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> Posko Bencana</a></li>
                <li><a href="#"><i class="fas fa-box"></i> Logistik</a></li>
                <li><a href="#"><i class="fas fa-truck"></i> Distribusi</a></li>
                <li><a href="#"><i class="fas fa-donate"></i> Donasi</a></li>
                <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li><a href="{{ url('/') }}"><i class="fas fa-globe"></i> Kembali ke Website</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <button id="sidebarToggle" class="btn btn-custom">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Admin BinaDesa
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Dashboard Stats -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="stat-number">15</div>
                            <div class="stat-label">Kejadian Bencana</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number">248</div>
                            <div class="stat-label">Warga Terdampak</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="stat-number">1,250</div>
                            <div class="stat-label">Paket Logistik</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-donate"></i>
                            </div>
                            <div class="stat-number">Rp 125Jt</div>
                            <div class="stat-label">Total Donasi</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="quick-actions text-center">
                            <a href="{{ url('/kejadian/create') }}" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Tambah Kejadian
                            </a>
                            <a href="{{ url('/warga/create') }}" class="btn btn-custom">
                                <i class="fas fa-user-plus me-2"></i>Tambah Warga
                            </a>
                            <a href="#" class="btn btn-custom">
                                <i class="fas fa-box me-2"></i>Kelola Logistik
                            </a>
                            <a href="#" class="btn btn-custom">
                                <i class="fas fa-file-alt me-2"></i>Buat Laporan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Waktu</th>
                                                <th>Aktivitas</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>10:30</td>
                                                <td>Laporan banjir di Jakarta Selatan</td>
                                                <td><span class="badge badge-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>09:15</td>
                                                <td>Distribusi logistik ke posko Cilandak</td>
                                                <td><span class="badge badge-warning">Proses</span></td>
                                            </tr>
                                            <tr>
                                                <td>08:45</td>
                                                <td>Pendaftaran warga baru terdampak gempa</td>
                                                <td><span class="badge badge-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>Kemarin</td>
                                                <td>Verifikasi data donasi bulanan</td>
                                                <td><span class="badge badge-secondary">Pending</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Statistik Cepat</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted">Kejadian Aktif</small>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Logistik Tersedia</small>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Donasi Terkumpul</small>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="#" class="btn btn-custom btn-sm">
                                        <i class="fas fa-chart-bar me-2"></i>Lihat Detail Laporan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Kejadian -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Kejadian Bencana Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Banjir Jakarta</h6>
                                        <p class="card-text text-muted small">Lokasi: Jakarta Selatan</p>
                                        <p class="card-text"><small class="text-muted">25 Warga terdampak</small></p>
                                        <a href="{{ url('/kejadian') }}" class="btn btn-custom btn-sm">Kelola</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Gempa Bogor</h6>
                                        <p class="card-text text-muted small">Lokasi: Bogor Barat</p>
                                        <p class="card-text"><small class="text-muted">15 Warga terdampak</small></p>
                                        <a href="{{ url('/kejadian') }}" class="btn btn-custom btn-sm">Kelola</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Kebakaran Depok</h6>
                                        <p class="card-text text-muted small">Lokasi: Depok Timur</p>
                                        <p class="card-text"><small class="text-muted">8 Warga terdampak</small></p>
                                        <a href="{{ url('/kejadian') }}" class="btn btn-custom btn-sm">Kelola</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });

        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</body>
</html>
