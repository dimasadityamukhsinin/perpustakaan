@extends('layouts.master')

@section('title', 'Data Pengembalian')
@section('navTitle', 'Pengembalian')

@section('content')
@if(session('success'))
    <div class="alert alert-success" style="margin-top: 15px;">{{ session('success') }}</div>
@endif
<div class="box" style="margin-top: 15px;">
    <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Jumlah Peminjaman</th>
            <th>Jumlah Pengembalian</th>
            <th>Tanggal Pengembalian</th>
            <th>Kondisi Buku</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->peminjaman->users->nama }}</td>
                <td>{{ $item->peminjaman->buku->judul }}</td>
                <td>{{ $item->peminjaman->jumlah_peminjaman }}</td>
                <td>{{ $item->jumlah_pengembalian }}</td>
                <td>{{ $item->tanggal_dikembalikan }}</td>
                <td>{{ $item->kondisi_buku }}</td>
                <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('admin.pengembalian.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.pengembalian.destroy', $item->id) }}" method="POST" style="display:inline;">
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
