<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - BinaDesa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- start css  --}}
    @include('layout.admin.css')
    {{-- end css  --}}
</head>
<body>
    <!-- NAVBAR -->
    @include('layout.admin.header')
    {{-- END NAVBAR  --}}

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
    {{-- END MAIN CONTENT  --}}

    <!-- FOOTER -->
    @include('layout.admin.footer')
    {{-- END FOOTER  --}}

    {{-- START JS  --}}
   @include('layout.admin.js')
    {{-- END JS  --}}
</body>
</html>
