@extends('layouts.master')

@section('title', 'Tambah Buku')
@section('navTitle', 'Tambah Buku')

@section('content')
<div class="col">
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.buku.index') }}" class="btn btn-success">Kembali</a>
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
        <form role="form" method="POST" action="{{ route('admin.buku.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Rak</label>
                    <select name="id_rak" class="form-control" required>
                        <option value="">Pilih Rak</option>
                        @foreach($rak as $rak)
                        <option value="{{ $rak->id }}">{{ $rak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kategori Buku</label>
                    <select name="id_kategori_buku" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
