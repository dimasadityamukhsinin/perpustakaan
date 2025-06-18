@extends('layouts.master')

@section('title', 'Tambah Anggota')
@section('navTitle', 'Tambah Anggota')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-primary">
    <form role="form" method="post" action="{{ route('admin.anggota.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
            </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
