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
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PASSWORD</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="user-name">
                                    <i class="fas fa-user"></i> {{ $user->name }}
                                </div>
                            </td>
                            <td class="user-email">{{ $user->email }}</td>
                            <td>
                                <div class="password-hash" title="{{ $user->password }}">
                                    {{ Str::limit($user->password, 30) }}
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
@endsection
