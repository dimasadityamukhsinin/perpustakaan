@extends('layouts.master')

@section('title', 'Edit Kategori')
@section('navTitle', 'Edit Kategori')

@section('content')
<div class="col">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-success">Kembali</a>
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
        <form method="POST" action="{{ route('admin.anggota.update', $anggota->id) }}">
            @csrf @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $anggota->username) }}" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('nama', $anggota->email) }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat', $anggota->alamat) }}</textarea>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $anggota->no_telp) }}" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
