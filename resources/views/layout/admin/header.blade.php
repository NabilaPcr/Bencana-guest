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
                    <i class="fas fa-home me-2"></i> Beranda
                </a>
            </li>

            <!-- Dropdown Kegiatan -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-calendar-alt me-2"></i>Kegiatan
                    <i class="fas fa-chevron-down ms-2 small"></i>
                </a>
                <ul class="dropdown-menu">
                    <!-- Kejadian Bencana -->
                    <li>
                        <a class="dropdown-item" href="/kejadian">
                            <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Kejadian Bencana
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Posko -->
                    <li>
                        <a class="dropdown-item" href="/posko">
                            <i class="fas fa-hospital-alt me-2 text-primary"></i>Posko Bantuan
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Donasi -->
                    <li>
                        <a class="dropdown-item" href="/donasi">
                            <i class="fas fa-hand-holding-heart me-2 text-danger"></i>Donasi
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Logistik -->
                    <li>
                        <a class="dropdown-item" href="/logistik">
                            <i class="fas fa-box me-2 text-success"></i>Logistik
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Distribusi -->
                    <li>
                        <a class="dropdown-item" href="/distribusi">
                            <i class="fas fa-truck-loading me-2 text-info"></i>Distribusi
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </li>

            <!-- warga -->
            <li>
                        <a class="dropdown-item" href="/warga">
                            <i class="fas fa-users me-2 text-secondary"></i>Data Warga
                        </a>
                    </li>

            <!-- Tombol Masuk/Logout -->
            @if (auth()->check())
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-login btn-logout">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ url('/auth') }}" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        <span>Masuk</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</header>
