<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #eaf5ea;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .left {
            flex: 1;
            background: url("/pedesaan.jpeg") no-repeat center center;
            background-size: cover;
            animation: slideInLeft 1s ease forwards;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideInRight 1s ease forwards;
        }

        .login-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            opacity: 0;
            animation: fadeIn 1.2s ease forwards 0.5s;
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            font-size: 20px;
            margin-bottom: 8px;
        }

        p.welcome-text {
            text-align: center;
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            background-color: #43a047;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2e7d32;
        }

        .error {
            color: #d32f2f;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .message {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="left"></div>

    <div class="right">
        <div class="login-container">
            <h1>Selamat Datang di Website Kebencanaan & Tanggap Darurat!🌾</h1>
            <p class="welcome-text">Silakan masuk untuk melanjutkan</p>

            {{-- Pesan sukses atau error --}}
            @if(session('pesan'))
                <p class="message">{{ session('pesan') }}</p>
            @endif

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="/auth/login" method="POST">
                @csrf
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username">

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password">

                <button type="submit">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
