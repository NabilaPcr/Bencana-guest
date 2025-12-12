<header>
    <nav class="navbar">
        <!-- Logo Horizontal -->
        <a href="/" class="logo-horizontal">
            <div class="logo-icon-container">
                <i class="fas fa-hands-helping"></i>
            </div>
            <div class="logo-text-container">
                <span class="logo-main">SiDa</span>
                <span class="logo-accent">Siaga Desa</span>
            </div>
        </a>

        <ul class="nav-links">
            <li>
                <a href="/dashboard">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </li>

            <!-- Dropdown Kegiatan -->
            <li class="nav-item dropdown">
                <a href="#"
                 {{-- class="nav-link dropdown-toggle d-flex align-items-center" role="button" --}}
                    data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-alt me-2"></i>Kegiatan
                    <i class="fas fa-chevron-down ms-2 small"></i>
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

            <li>
                <a href="/warga">
                    <i class="fas fa-users"></i> Data Warga
                </a>
            </li>
            <li>
                <a href="{{ url('/auth') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
