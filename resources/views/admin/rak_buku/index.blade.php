@extends('layouts.master')

@section('title', 'Rak Buku')
@section('navTitle', 'Rak Buku')

@section('content')
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('admin.rak_buku.create') }}" class="btn btn-success">Tambah Rak</a>
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
            <th>ID</th>
            <th>Nama Rak</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach($rak as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>
                    <a href="{{ route('admin.rak_buku.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.rak_buku.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
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
