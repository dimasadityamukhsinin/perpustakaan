@extends('layouts.master')

@section('title', 'Anggota')
@section('navTitle', 'Anggota')

@section('content')
<div class="row">
    <div class="col-md-2">
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-success">Tambah Anggota</a>
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
            <th>Username</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $anggota)
            <tr>
                <td>{{ $anggota->username }}</td>
                <td>{{ $anggota->nama }}</td>
                <td>{{ $anggota->email }}</td>
                <td>{{ $anggota->alamat }}</td>
                <td>{{ $anggota->no_telp }}</td>
                <td>
                    <a href="{{ route('admin.anggota.editPassword', $anggota->id) }}" class="btn btn-info btn-sm">Ubah Password</a>
                    <a href="{{ route('admin.anggota.edit', $anggota->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.anggota.destroy', $anggota->id) }}" method="POST" style="display:inline-block;">
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
