@extends('layout.admin.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="page-header">
            <div class="header-text">
                <h1><i class="fas fa-users-cog"></i> Data User</h1>
                <p>List data user sistem BinaDesa</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>

        @if($users->count() > 0)
            <div class="table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>PASSWORD</th>
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
                                        <span class="badge badge-superadmin">
                                            <i class="fas fa-crown"></i> {{ $user->role }}
                                        </span>
                                    @elseif($user->role == 'Mitra')
                                        <span class="badge badge-mitra">
                                            <i class="fas fa-handshake"></i> {{ $user->role }}
                                        </span>
                                    @elseif($user->role == 'Warga')
                                        <span class="badge badge-pelanggan">
                                            <i class="fas fa-user"></i> {{ $user->role }}
                                        </span>
                                    @else
                                        <span class="badge badge-default">
                                            <i class="fas fa-question"></i> {{ $user->role ?? 'Belum diatur' }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="password-hash" title="{{ $user->password }}">
                                    {{ Str::limit($user->password, 20) }}
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
                                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
                    <p>Menampilkan <strong>{{ $users->count() }}</strong> dari <strong>{{ $users->total() }}</strong> data user</p>
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

    {{-- <style>
    .badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .badge-superadmin {
        background-color: #ffeaa7;
        color: #d63031;
        border: 1px solid #fdcb6e;
    }

    .badge-mitra {
        background-color: #a29bfe;
        color: #2d3436;
        border: 1px solid #6c5ce7;
    }

    .badge-pelanggan {
        background-color: #55efc4;
        color: #2d3436;
        border: 1px solid #00b894;
    }

    .badge-default {
        background-color: #dfe6e9;
        color: #636e72;
        border: 1px solid #b2bec3;
    }

    .user-role {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 120px;
    }

    .users-table td:nth-child(4) { /* Kolom Role */
        text-align: center;
    }

    .users-table td:nth-child(1) { /* Kolom No */
        text-align: center;
        width: 60px;
    }

    .password-hash {
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        color: #636e72;
        background: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #dfe6e9;
        word-break: break-all;
        max-width: 200px;
    }
    </style> --}}
@endsection
