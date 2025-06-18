@extends('layouts.master')

@section('title', 'Data Peminjaman')
@section('navTitle', 'Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-success">Tambah Peminjaman</a>
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
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->users->nama }}</td>
                <td>{{ $item->buku->judul }}</td>
                <td>{{ $item->jumlah_peminjaman }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_kembali }}</td>
                <td>
                    <a href="{{ route('admin.peminjaman.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    @if ($item->konfirmasi == 1)
                        <a href="{{ route('admin.pengembalian.kembalikan', $item->id) }}" class="btn btn-sm btn-success">Kembalikan Buku</a>
                    @else
                        <a href="{{ route('admin.peminjaman.konfirmasi', $item->id) }}" class="btn btn-sm btn-warning">Konfirmasi</a>
                    @endif
                    <form action="{{ route('admin.peminjaman.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
