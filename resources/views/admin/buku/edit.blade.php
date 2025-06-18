@extends('layouts.master')

@section('title', 'Edit Buku')
@section('navTitle', 'Edit Buku')

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
        <form method="POST" action="{{ route('admin.buku.update', $buku->id) }}">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="form-group">
                    <label>Rak</label>
                    <select name="id_rak" class="form-control" required>
                        @foreach($rak as $rak)
                        <option value="{{ $rak->id }}" {{ $rak->id == $buku->id_rak ? 'selected' : '' }}>{{ $rak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kategori Buku</label>
                    <select name="id_kategori_buku" class="form-control" required>
                        @foreach($kategori as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $buku->id_kategori_buku ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" required>
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}" required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="{{ $buku->tahun }}" required>
                </div>

                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $buku->isbn }}" required>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $buku->jumlah }}" required>
                </div>
            </div>
            
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
