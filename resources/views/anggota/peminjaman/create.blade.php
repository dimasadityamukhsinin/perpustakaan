@extends('layouts.master')

@section('title', 'Tambah Peminjaman')
@section('navTitle', 'Tambah Peminjaman')

@section('content')

<div class="col">
    <div class="row">
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
        <form role="form" method="post" action="{{ route('anggota.peminjaman.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label>Buku</label>
                    <select name="id_buku" id="id_buku" class="form-control" required>
                        <option value="">Pilih Buku</option>
                        @foreach ($buku as $buku)
                        <option value="{{ $buku->id }}" data-jumlah="{{ $buku->jumlah }}">{{ $buku->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok Buku Tersedia:</label>
                    <input type="number" id="jumlah_buku" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah_peminjaman" id="jumlah_peminjaman" class="form-control" min="1" required>
                </div>

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
    window.onload = function () {
        const selectBuku = document.getElementById('id_buku');
        const jumlahBuku = document.getElementById('jumlah_buku');
        const inputJumlahPinjam = document.getElementById('jumlah_peminjaman');

        let maxStok = 0;

        selectBuku.addEventListener('change', function () {
            const selectedOption = selectBuku.options[selectBuku.selectedIndex];
            maxStok = parseInt(selectedOption.getAttribute('data-jumlah') || 0);
            jumlahBuku.value = maxStok;
            inputJumlahPinjam.value = ''; // reset input jumlah saat ganti buku
            inputJumlahPinjam.max = maxStok;
        });

        inputJumlahPinjam.addEventListener('input', function () {
            const currentValue = parseInt(this.value);
            if (currentValue > maxStok) {
                this.value = maxStok;
                alert('Jumlah peminjaman melebihi stok!');
            }
        });
    }
</script>
@endsection
