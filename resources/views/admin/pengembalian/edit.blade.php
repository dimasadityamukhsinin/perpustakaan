@extends('layouts.master')

@section('title', 'Edit Pengembalian')
@section('navTitle', 'Edit Pengembalian')

@section('content')
<div class="col">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-success">Kembali</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-top: 15px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-primary" style="margin-top: 15px;">
        <form method="POST" action="{{ route('admin.pengembalian.update', $pengembalian->id) }}">
            @csrf
            @method('PUT')
            <div class="box-body">

                <input type="hidden" name="id_peminjaman" value="{{ $pengembalian->id_peminjaman }}">

                <div class="form-group">
                    <label>Anggota</label>
                    <input type="text" class="form-control" value="{{ $pengembalian->peminjaman->users->nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Buku</label>
                    <input type="text" class="form-control" value="{{ $pengembalian->peminjaman->buku->judul }}" disabled>
                </div>

                <div class="form-group">
                    <label>Jumlah Pengembalian</label>
                    <input type="number" name="jumlah_pengembalian" class="form-control" value="{{ $pengembalian->jumlah_pengembalian }}" max="{{ $pengembalian->jumlah_pengembalian }}" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ $pengembalian->peminjaman->tanggal_kembali }}" required disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Dikembalikan</label>
                    <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ $pengembalian->tanggal_dikembalikan }}" required>
                </div>

                <div class="form-group">
                    <label>Kondisi Buku</label>
                    <input type="text" name="kondisi_buku" class="form-control" value="{{ $pengembalian->kondisi_buku }}" required>
                </div>

                <div class="form-group">
                    <label>Denda</label>
                    <input type="number" name="denda" class="form-control" value="{{ $pengembalian->denda }}" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
