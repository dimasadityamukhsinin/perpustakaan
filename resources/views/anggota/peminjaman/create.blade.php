@extends('layouts.master')

@section('title', 'Tambah Peminjaman')
@section('navTitle', 'Tambah Peminjaman')

@section('content')
<div class="col">
    <div class="row mb-2">
        <div class="col-md-2">
            <a href="{{ route('anggota.peminjaman.index') }}" class="btn btn-success">Kembali</a>
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
        <form method="POST" action="{{ route('anggota.peminjaman.store') }}">
            @csrf
            <div class="box-body">
                <label>Daftar Buku</label>
                <table class="table table-bordered" id="buku-table">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Jumlah</th>
                            <th>
                                <button type="button" class="btn btn-sm btn-success" id="add-row">+</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="buku_id[]" class="form-control" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach ($buku as $b)
                                    <option value="{{ $b->id }}" data-stok="{{ $b->jumlah }}">
                                        {{ $b->judul }} (Stok: {{ $b->jumlah }})
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="jumlah_peminjaman[]" class="form-control" min="1" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-row">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRowBtn = document.getElementById('add-row');

    addRowBtn.addEventListener('click', function() {
        let table = document.querySelector('#buku-table tbody');
        let row = table.rows[0].cloneNode(true);

        // reset
        row.querySelector('select').selectedIndex = 0;
        row.querySelector('input').value = '';

        table.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            if (document.querySelectorAll('#buku-table tbody tr').length > 1) {
                e.target.closest('tr').remove();
            }
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const selects = document.querySelectorAll('select[name="buku_id[]"]');
        let selectedValues = [];

        for (let select of selects) {
            let val = select.value;
            if (selectedValues.includes(val) && val !== "") {
                alert('Buku yang sama tidak boleh dipilih lebih dari satu kali!');
                e.preventDefault();
                return false;
            }
            selectedValues.push(val);
        }
    });
});
</script>
@endsection
