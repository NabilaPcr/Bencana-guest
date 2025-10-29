<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - BinaDesa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & FONT ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7fbf7;
            color: #2b2b2b;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== NAVBAR ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e6d38;
        }

        .navbar .logo i {
            font-size: 2rem;
            color: #56a65a;
        }

        .navbar .logo span {
            color: #7ac27b;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: #2e6d38;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #48904d;
        }

        /* ===== MAIN CONTENT ===== */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #56a65a;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .back-link:hover {
            color: #48904d;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-left: 6px solid #f39c12;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .form-header p {
            color: #666;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2e6d38;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #56a65a;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: #f39c12;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-submit-full {
            flex: 2;
        }

        .password-note {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .password-note i {
            color: #f39c12;
            margin-right: 8px;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #2e6d38;
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 60px;
        }
        /* ===== TABLE STYLES ===== */
.table-container {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    table-layout: fixed; /* Tambahkan ini */
}

.users-table th {
    background: #2e6d38;
    color: white;
    padding: 15px 20px;
    text-align: left;
    font-weight: 600;
    border: none;
}

/* Atur lebar kolom */
.users-table th:nth-child(1) { width: 25%; } /* NAME */
.users-table th:nth-child(2) { width: 30%; } /* EMAIL */
.users-table th:nth-child(3) { width: 35%; } /* PASSWORD */
.users-table th:nth-child(4) { width: 10%; } /* ACTION */

.users-table td {
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
    word-wrap: break-word; /* Tambahkan ini */
}

.users-table tr:last-child td {
    border-bottom: none;
}

.users-table tr:hover {
    background: #f9fff9;
}

.user-name {
    font-weight: 600;
    color: #2e6d38;
}

.user-email {
    color: #666;
    word-wrap: break-word;
}

.password-hash {
    font-family: monospace;
    font-size: 0.8rem; /* Perkecil sedikit */
    color: #888;
    word-break: break-all; /* Ubah dari break-word ke break-all */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1; /* Batasi 1 baris */
    -webkit-box-orient: vertical;
}

/* ===== ACTION BUTTONS ===== */
.action-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap; /* Pastikan tidak wrap */
}

.btn-action {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    font-size: 0.8rem; /* Perkecil sedikit */
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    white-space: nowrap; /* Pastikan text tidak wrap */
}



      /* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .table-container {
        padding: 20px;
        overflow-x: auto;
    }

    .users-table {
        min-width: 800px; /* Perlebar minimum untuk mobile */
    }

    .users-table th:nth-child(1) { width: 20%; }
    .users-table th:nth-child(2) { width: 25%; }
    .users-table th:nth-child(3) { width: 40%; }
    .users-table th:nth-child(4) { width: 15%; }

    .action-buttons {
        flex-direction: column;
        gap: 5px;
    }

    .btn-action {
        font-size: 0.75rem;
        padding: 6px 10px;
    }
}
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <nav class="navbar">
            <a href="/" class="logo">
                <i class="fas fa-hands-helping"></i>
                Bina<span>Desa</span>
            </a>

            <ul class="nav-links">
                <li><a href="/dashboard">Beranda</a></li>
                <li><a href="/kejadian">Kejadian Bencana</a></li>
                <li><a href="/warga">Data Warga</a></li>
                <li><a href="{{ url('/auth') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </a></li>
            </ul>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('users.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data User
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-edit"></i> Edit User</h1>
                <p>Perbarui data user berikut</p>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required
                           value="{{ old('name', $user->name) }}"
                           placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required
                           value="{{ old('email', $user->email) }}"
                           placeholder="Masukkan alamat email">
                    @error('email')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="password-note">
                    <i class="fas fa-info-circle"></i>
                    <strong>Informasi Password:</strong> Kosongkan field password jika tidak ingin mengubah password.
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" id="password" name="password"
                               placeholder="Masukkan password baru (opsional)">
                        @error('password')
                            <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Konfirmasi password baru">
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('users.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit btn-submit-full">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} BinaDesa. Semua akan aman.</p>
    </footer>

    <script>
        // Validasi password match
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');

            function validatePassword() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Password tidak cocok');
                } else {
                    confirmPassword.setCustomValidity('');
                }
            }

            password.addEventListener('change', validatePassword);
            confirmPassword.addEventListener('keyup', validatePassword);
        });
    </script>
</body>
</html>
