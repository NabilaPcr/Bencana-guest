<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tentang - BinaDesa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fef9;
            margin: 0;
            padding: 20px;
            color: #2e7d32;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            font-weight: 600;
            font-size: 2.2rem;
            margin-bottom: 5px;
        }
        header p {
            font-size: 1rem;
            color: #555;
        }
        .modules {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }
        .module-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(46,125,50,0.15);
            width: 300px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .module-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(46,125,50,0.25);
        }
        .module-card img {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .module-card h3 {
            font-weight: 600;
            margin-bottom: 12px;
        }
        .module-card p {
            font-size: 0.9rem;
            color: #444;
            line-height: 1.4;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.8rem;
            color: #999;
        }
        /* Responsive */
        @media(max-width: 700px) {
            .modules {
                flex-direction: column;
                align-items: center;
            }
            .module-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Tentang BinaDesa</h1>
        <p>Sistem Kebencanaan & Tanggap Darurat untuk membantu masyarakat dan tim penanggulangan bencana</p>
    </header>

    <section class="modules">
        @php
            $modules = [
                ['title' => 'Modul Kejadian', 'description' => 'Modul ini berfungsi untuk mencatat dan memantau kejadian bencana yang terjadi, termasuk jenis, lokasi, waktu, dan status penanganan.', 'image' => '/images/modul-kejadian.png'],
                ['title' => 'Modul User', 'description' => 'Modul ini mengelola data pengguna sistem, termasuk pendaftaran, otentikasi, dan hak akses sesuai peran pengguna.', 'image' => '/images/modul-user.png'],
                ['title' => 'Modul Warga', 'description' => 'Modul ini berisi data warga masyarakat yang terdampak atau terlibat dalam penanganan bencana, sehingga informasi dapat disalurkan dengan tepat.', 'image' => '/images/modul-warga.png'],
            ];
        @endphp

        @foreach ($modules as $module)
            <div class="module-card">
                <img src="{{ $module['image'] }}" alt="{{ $module['title'] }}" />
                <h3>{{ $module['title'] }}</h3>
                <p>{{ $module['description'] }}</p>
            </div>
        @endforeach
    </section>

    <footer>
        &copy; {{ date('Y') }} BinaDesa. Semua hak cipta dilindungi.
    </footer>
</body>
</html>
