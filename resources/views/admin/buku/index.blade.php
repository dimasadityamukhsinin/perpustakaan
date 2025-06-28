@extends('layouts.master')

@section('title', 'Buku')
@section('navTitle', 'Buku')

@section('content')
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('admin.buku.create') }}" class="btn btn-success">Tambah Buku</a>
    </div>
    <div class="col-md-10 text-right">
        <a href="{{ route('admin.buku.laporan') }}" class="btn btn-info">Laporan Buku</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" style="margin-top: 15px;">{{ session('success') }}</div>
@endif

<div class="box" style="margin-top: 15px;">
    <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->tahun }}</td>
                    <td>{{ $buku->isbn }}</td>
                    <td>{{ $buku->jumlah }}</td>
                    <td>
                        <a href="{{ route('admin.buku.edit', $buku->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
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
