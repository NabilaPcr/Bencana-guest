@extends('layout.admin.app')
@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <a href="{{ route('users.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Data User
        </a>

        <div class="form-card">
            <div class="form-header">
                <h1><i class="fas fa-user-plus"></i> Tambah User Baru</h1>
                <p>Tambahkan user baru untuk akses sistem BinaDesa</p>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required
                           value="{{ old('email') }}"
                           placeholder="Masukkan alamat email">
                    @error('email')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required
                               placeholder="Masukkan password">
                        @error('password')
                            <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               placeholder="Konfirmasi password">
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('users.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit btn-submit-full">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
