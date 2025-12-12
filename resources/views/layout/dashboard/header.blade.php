<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <!-- Logo Horizontal dengan icon dan teks -->
        <a href="/" class="logo-horizontal">
            <div class="logo-icon-container">
                <i class="fas fa-hands-helping"></i>
            </div>
            <div class="logo-text-container">
                <span class="logo-main">SiDa</span>
                <span class="logo-accent">Siaga Desa</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-home me-2"></i>Beranda
                    </a>
                </li>

                <!-- Dropdown Kegiatan -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar-alt me-2"></i>Kegiatan <i class="fas fa-chevron-down ms-2 small"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/kejadian">
                                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Kejadian Bencana
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item" href="/posko">
                                <i class="fas fa-plus-circle me-2 text-success"></i>Posko
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                         <li>
                            <a class="dropdown-item" href="/donasi">
                                <i class="fas fa-plus-circle me-2 text-success"></i>Donasi
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                         {{-- <li>
                            <a class="dropdown-item" href="/logistik">
                                <i class="fas fa-plus-circle me-2 text-success"></i>Logistik
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                         <li>
                            <a class="dropdown-item" href="/distribusi">
                                <i class="fas fa-plus-circle me-2 text-success"></i>Posko
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li> --}}


                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/warga">
                        <i class="fas fa-users me-2"></i>Data Warga
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ url('/auth') }}" class="nav-link btn-login d-flex align-items-center px-3">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span>Masuk</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
