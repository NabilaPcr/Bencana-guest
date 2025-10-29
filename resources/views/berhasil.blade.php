<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eaf5ea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px 50px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease forwards;
        }

        h1 {
            color: #2e7d32;
            margin-bottom: 15px;
        }

        p {
            color: #555;
            font-size: 15px;
        }

        .btn-logout {
            display: inline-block;
            margin-top: 20px;
            background-color: #43a047;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #2e7d32;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Website ini 🌾</h1>


        @if(session('pesan'))
            <p>{{ session('pesan') }}</p>
            <p>Anda telah berhasil login ke sistem Kebencanaan & Tanggap Darurat Desa!.</p>
        @endif


        <a href="/auth" class="btn-logout">Keluar</a>
    </div>
</body>
</html>
