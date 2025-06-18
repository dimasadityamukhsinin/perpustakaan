@extends('layouts.master')

@section('title', 'Histori Pengembalian')
@section('navTitle', 'Histori Pengembalian')

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
            <th>Judul Buku</th>
            <th>Jumlah Peminjaman</th>
            <th>Jumlah Pengembalian</th>
            <th>Tanggal Pengembalian</th>
            <th>Kondisi Buku</th>
            <th>Denda</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->peminjaman->buku->judul }}</td>
                <td>{{ $item->peminjaman->jumlah_peminjaman }}</td>
                <td>{{ $item->jumlah_pengembalian }}</td>
                <td>{{ $item->tanggal_dikembalikan }}</td>
                <td>{{ $item->kondisi_buku }}</td>
                <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
@endsection
