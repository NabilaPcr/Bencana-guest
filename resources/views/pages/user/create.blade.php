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
                <p>Tambahkan user baru untuk akses sistem SiagaDesa</p>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan dalam pengisian form
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap" class="@error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                        placeholder="Masukkan alamat email" class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required
                            placeholder="Masukkan password (minimal 6 karakter)" class="@error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="Konfirmasi password" class="@error('password') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group">
                    <label for="role">Role *</label>
                    <select name="role" id="role" required class="@error('role') is-invalid @enderror">
                        <option value="">Pilih Role</option>
                        <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>
                            Super Admin
                        </option>
                        <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>
                            Warga
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

    <style>
    .form-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border-left: 6px solid var(--accent);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-header h1 {
        color: var(--dark);
        font-size: 2.2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .form-header p {
        color: #666;
        font-size: 1.1rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        margin-bottom: 30px;
        font-weight: 500;
        text-decoration: none;
    }

    .back-link:hover {
        color: #48904d;
        text-decoration: underline;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
        font-size: 1rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
        background-color: white;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(86, 166, 90, 0.2);
    }

    .form-group input.is-invalid,
    .form-group select.is-invalid {
        border-color: var(--danger);
    }

    .form-group input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-cancel {
        background: var(--gray);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex: 1;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .btn-submit {
        background: var(--accent);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-submit-full {
        flex: 2;
    }

    .btn-submit:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(243, 156, 18, 0.3);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border-left: 4px solid;
    }

    .alert-danger {
        background-color: #ffeaea;
        border-color: #e74c3c;
        color: #721c24;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 25px;
            margin: 0 10px;
        }

        .form-header h1 {
            font-size: 1.8rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-cancel, .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .form-card {
            padding: 20px 15px;
        }

        .form-header h1 {
            font-size: 1.6rem;
            flex-direction: column;
            gap: 10px;
        }

        .form-header h1 i {
            font-size: 1.8rem;
        }

        .back-link {
            font-size: 0.9rem;
        }
    }
    </style>
@endsection
