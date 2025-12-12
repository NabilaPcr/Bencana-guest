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
                <h1><i class="fas fa-edit"></i> Edit User</h1>
                <p>Perbarui data user berikut</p>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
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
                {{-- Tambahkan setelah input email --}}
                <div class="form-group">
                    <label for="role">Role *</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="Super Admin" {{ old('role', $user->role) == 'Super Admin' ? 'selected' : '' }}>
                            Super Admin
                        </option>
                        <option value="Pelanggan" {{ old('role', $user->role) == 'Warga' ? 'selected' : '' }}>
                            Warga
                        </option>
                        <option value="Mitra" {{ old('role', $user->role) == 'Mitra' ? 'selected' : '' }}>
                            Mitra
                        </option>
                    </select>
                    @error('role')
                        <div style="color: #e74c3c; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
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

    {{-- START JS  --}}
    @include('layout.admin.js')
    {{-- END JS  --}}
@endsection
