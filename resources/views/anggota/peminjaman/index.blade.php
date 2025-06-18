@extends('layouts.master')

@section('title', 'Data Peminjaman')
@section('navTitle', 'Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('anggota.peminjaman.create') }}" class="btn btn-success">Pinjam Buku</a>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-success" style="margin-top: 15px;">{{ session('success') }}</div>
@endif
<div class="box" style="margin-top: 15px;">
    <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Konfirmasi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->buku->judul }}</td>
                <td>{{ $item->jumlah_peminjaman }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_kembali }}</td>
                <td>
                    @if ($item->konfirmasi)
                        <span class="badge bg-green">Sudah Dikonfirmasi</span>
                    @else
                        <span class="badge bg-red">Belum Dikonfirmasi</span>
                    @endif
                </td>
                <td>
                    @if (!$item->konfirmasi)
                        <a href="{{ route('anggota.peminjaman.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('anggota.peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    @else
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
