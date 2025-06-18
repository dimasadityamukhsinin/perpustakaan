@extends('layouts.master')

@section('title', 'Tambah Rak Buku')
@section('navTitle', 'Tambah Rak Buku')

@section('content')

<div class="col">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.rak_buku.index') }}" class="btn btn-success">Kembali</a>
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
        <form role="form" method="post" action="{{ route('admin.rak_buku.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Nama Rak</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
