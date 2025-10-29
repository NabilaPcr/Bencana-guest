<header>
    <nav class="navbar">
        <a href="/" class="logo">
            <i class="fas fa-hands-helping"></i>
            Bina<span>Desa</span>
        </a>

        <div class="menu-toggle" id="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul class="nav-links" id="nav-links">
            <li><a href="/" class="active">Beranda</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#kegiatan">Kegiatan</a></li>
            <li><a href="/warga" class="active">Data Warga</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <!-- Di file HTML Anda -->
            <li><a href="{{ url('/auth') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a></li>
        </ul>
    </nav>
</header>
