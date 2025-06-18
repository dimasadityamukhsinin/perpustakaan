@extends('layouts.master')

@section('title', 'Ubah Password Anggota')
@section('navTitle', 'Ubah Password Anggota')

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
        <form role="form" method="post" action="{{ route('admin.anggota.updatePassword', $anggota->id) }}">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
