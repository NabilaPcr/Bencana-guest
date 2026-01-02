@extends('layout.admin.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="page-header">
            <div class="header-text">
                <h1><i class="fas fa-users-cog"></i> Data User</h1>
                <p>List data user sistem SiagaDesa</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if($users->count() > 0)
            <div class="table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="user-name">
                                    <i class="fas fa-user"></i> {{ $user->name }}
                                </div>
                            </td>
                            <td class="user-email">{{ $user->email }}</td>
                            <td>
                                <div class="user-role">
                                    @if($user->role == 'Super Admin')
                                        <span class="status-badge status-superadmin">
                                            {{ $user->role }}
                                        </span>--
                                    @elseif($user->role == 'Warga')
                                        <span class="status-badge status-warga">
                                            {{ $user->role }}
                                        </span>
                                    @else
                                        <span class="status-badge status-user">
                                            {{ $user->role ?? 'Belum diatur' }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                                @if($user->id === auth()->id()) disabled title="Tidak dapat menghapus akun sendiri" @endif>
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- INFO DATA DAN PAGINATION DI BAWAH -->
            <div class="table-header-with-pagination" style="margin-top: 30px;">
                <div class="data-info">
                    @php
                        $start = ($users->currentPage() - 1) * $users->perPage() + 1;
                        $end = min($users->currentPage() * $users->perPage(), $users->total());
                    @endphp
                    <p>Menampilkan <strong>{{ $start }} - {{ $end }}</strong> dari <strong>{{ $users->total() }}</strong> data user</p>
                </div>

                @if($users->hasPages())
                <div class="bottom-pagination">
                    <div class="pagination-simple">
                        @if(!$users->onFirstPage())
                            <a href="{{ $users->previousPageUrl() }}" class="btn-prev">
                                <i class="fas fa-arrow-left"></i> Previous
                            </a>
                        @endif

                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="btn-next">
                                Next <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Data User</h3>
                <p>Silakan tambah user pertama Anda</p>
            </div>
        @endif
    </div>
    {{-- END MAIN CONTENT --}}

    <style>
    .status-badge {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
        text-align: center;
        min-width: 100px;
        border: 1px solid transparent;
    }

    .status-superadmin {
        background-color: #ffeaa7;
        color: #d63031;
        border-color: #fdcb6e;
    }

    .status-warga {
        background-color: #55efc4;
        color: #2d3436;
        border-color: #00b894;
    }

    .status-user {
        background-color: #dfe6e9;
        color: #636e72;
        border-color: #b2bec3;
    }

    .user-role {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .users-table thead {
        background: linear-gradient(135deg, var(--primary), var(--dark));
    }

    .users-table th {
        padding: 16px 20px;
        text-align: left;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .users-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .users-table tbody tr:hover {
        background-color: #f9fff9;
    }

    .users-table td:nth-child(1) { /* Kolom No */
        text-align: center;
        width: 60px;
        color: #666;
        font-weight: 500;
    }

    .users-table td:nth-child(4) { /* Kolom Role */
        text-align: center;
    }

    .user-name {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
    }

    .user-name i {
        color: var(--primary);
        font-size: 0.9rem;
    }

    .user-email {
        color: #666;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action {
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-edit {
        background-color: var(--accent);
        color: white;
    }

    .btn-edit:hover {
        background-color: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(243, 156, 18, 0.3);
    }

    .btn-delete {
        background-color: var(--danger);
        color: white;
    }

    .btn-delete:hover:not(:disabled) {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    }

    .btn-delete:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border-left: 4px solid;
    }

    .alert-success {
        background-color: #eafaf1;
        border-color: #27ae60;
        color: #155724;
    }

    .alert-danger {
        background-color: #ffeaea;
        border-color: #e74c3c;
        color: #721c24;
    }

    .alert i {
        margin-right: 8px;
    }

    .table-header-with-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .data-info p {
        color: #666;
        font-size: 0.9rem;
    }

    .bottom-pagination {
        display: flex;
        gap: 10px;
    }

    .btn-prev, .btn-next {
        padding: 8px 16px;
        border-radius: 6px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-prev:hover, .btn-next:hover {
        background: #48904d;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #999;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: #bbb;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .users-table {
            display: block;
            overflow-x: auto;
        }

        .users-table th,
        .users-table td {
            padding: 12px 15px;
            font-size: 0.85rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
            padding: 6px 12px;
        }

        .status-badge {
            min-width: 80px;
            font-size: 0.8rem;
            padding: 5px 12px;
        }

        .table-header-with-pagination {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .bottom-pagination {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .btn-add {
            justify-content: center;
        }

        .users-table {
            font-size: 0.8rem;
        }

        .user-name {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
    }
    </style>
@endsection
