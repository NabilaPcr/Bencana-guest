 <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">BinaDesa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link active">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tentang" class="nav-link">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url ('/kejadian')}}" class="nav-link">Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/warga') }}" class="nav-link">Data Warga</a>
                    </li>
                    <li class="nav-item">
                        <a href="#kontak" class="nav-link">Kontak</a>
                    </li>
                     <li class="nav-item">
                        <a href="" class="nav-link">User</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/auth') }}" class="nav-link btn btn-login ml-2">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
