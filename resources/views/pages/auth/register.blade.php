<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - BinaDesa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eaf5ea 0%, #d4edda 100%);
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .left {
            flex: 1;
            background: linear-gradient(rgba(46, 125, 50, 0.3), rgba(46, 125, 50, 0.3)), url("/pedesaan.jpeg") no-repeat center center;
            background-size: cover;
            animation: slideInLeft 1s ease forwards;
            position: relative;
        }

        .left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(46, 125, 50, 0.1), rgba(33, 150, 83, 0.1));
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideInRight 1s ease forwards;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.1),
                0 5px 15px rgba(0, 0, 0, 0.05);
            width: 400px;
            opacity: 0;
            animation: fadeIn 1.2s ease forwards 0.5s;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2e7d32, #43a047, #66bb6a);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        p.info-text {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #2e7d32;
            font-size: 14px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2e7d32;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background: #f8fdf8;
            font-family: 'Poppins', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: #2e7d32;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        button {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            color: #fff;
            border: none;
            padding: 14px 0;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        }

        button:hover::before {
            left: 100%;
        }

        .error {
            background: #ffebee;
            color: #d32f2f;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid #d32f2f;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .brand-text {
            font-size: 1.2rem;
            color: #2e7d32;
            font-weight: 600;
        }

        .brand-subtext {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }

        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #2e7d32;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #43a047;
            text-decoration: underline;
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left { flex: 0.4; }
            .right { flex: 0.6; }
            .register-container { width: 90%; max-width: 350px; padding: 30px 25px; }
        }
    </style>
</head>

<body>
    <div class="left"></div>

    <div class="right">
        <div class="register-container">
            <div class="brand">
                <div class="brand-logo">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="brand-text">SiagaDesa</div>
                <div class="brand-subtext">Sistem Kebencanaan & Tanggap Darurat</div>
            </div>

            <h1>Buat Akun Baru</h1>
            <p class="info-text">Isi data di bawah ini untuk membuat akun Anda</p>

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="/auth/register" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap Anda" required value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Masukkan email Anda" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit">
                    <i class="fas fa-user-plus" style="margin-right: 8px;"></i>
                    Daftar
                </button>
            </form>

            <div class="login-link">
                Sudah memiliki akun? <a href="/auth">Silakan login</a>
            </div>
        </div>
    </div>
</body>
</html>
