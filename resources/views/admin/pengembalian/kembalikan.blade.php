@extends('layouts.master')

@section('title', 'Form Pengembalian Buku')
@section('navTitle', 'Pengembalian Buku')

@section('content')
<div class="col">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-success">Kembali</a>
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
        <form method="POST" action="{{ route('admin.pengembalian.store') }}">
            @csrf

            <input type="hidden" name="id_peminjaman" value="{{ $peminjaman->id }}">

            <div class="box-body">
                <div class="form-group">
                    <label>Anggota</label>
                    <input type="text" class="form-control" value="{{ $peminjaman->users->nama }}" disabled>
                </div>

                <div class="form-group">
                    <label>Buku</label>
                    <input type="text" class="form-control" value="{{ $peminjaman->buku->judul }}" disabled>
                </div>

                <div class="form-group">
                    <label>Jumlah Pengembalian</label>
                    <input type="number" name="jumlah_pengembalian" class="form-control" max="{{ $peminjaman->jumlah_peminjaman }}" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}" required disabled>
                </div>

                <div class="form-group">
                    <label>Tanggal Dikembalikan</label>
                    <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Kondisi Buku</label>
                    <input type="text" name="kondisi_buku" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Denda</label>
                    <input type="number" name="denda" class="form-control" min="0" value="0" required>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
            </div>
        </form>
    </div>
</div>
@endsection
