@extends('layout.guest.app')
@section('content')
<div class="container">
    <h2>Daftar Posko Bencana</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('posko.create') }}" class="btn btn-primary mb-3">Tambah Posko</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Posko</th>
                <th>Nama Posko</th>
                <th>Jenis Bencana</th>
                <th>Lokasi Kejadian</th>
                <th>Alamat Posko</th>
                <th>Penanggung Jawab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($poskoBencana as $posko)
            <tr>
                <td>{{ $posko->posko_id }}</td>
                <td>{{ $posko->nama }}</td>
                <td>{{ $posko->kejadianBencana->jenis_bencana ?? 'N/A' }}</td> {{-- Diubah --}}
                <td>{{ $posko->kejadianBencana->lokasi_text ?? 'N/A' }}
                    @if($posko->kejadianBencana)
                        RT {{ $posko->kejadianBencana->rt }}/RW {{ $posko->kejadianBencana->rw }}
                    @endif
                </td> {{-- Diubah --}}
                <td>{{ $posko->alamat }}</td>
                <td>{{ $posko->penanggung_jawab }}</td>
                <td>
                    <a href="{{ route('posko.show', $posko->posko_id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('posko.edit', $posko->posko_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('posko.destroy', $posko->posko_id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
