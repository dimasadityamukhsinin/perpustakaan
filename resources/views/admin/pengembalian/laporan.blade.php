<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .border-all {
            border: 2px solid #000;
            margin: 10px;
        }
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .signature {
            width: 300px;
            float: right;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="border-all">
    <div class="text-center">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="max-height:80px; margin-top: 20px;">
        <h3 style="margin:5px 0;">SMP PLUS TERPADU</h3>
        <p style="margin-bottom:20px;">Jl. Damai Ujung No.121 Panam, Kota Pekanbaru, Provinsi Riau.</p>
        <hr style="border:1px solid #000;">
        <h1 style="margin-top:50px; margin-bottom: 50px;">Laporan Pengembalian</h1>
    </div>

    <div style="padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Jumlah Peminjaman</th>
                    <th>Jumlah Pengembalian</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Kondisi Buku</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalian as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->peminjaman->users->nama }}</td>
                    <td>{{ $item->peminjaman->buku->judul }}</td>
                    <td>{{ $item->peminjaman->jumlah_peminjaman }}</td>
                    <td>{{ $item->jumlah_pengembalian }}</td>
                    <td>{{ $item->tanggal_dikembalikan }}</td>
                    <td>{{ $item->kondisi_buku }}</td>
                    <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signature">
        Pekanbaru, {{ date('d-m-Y') }} <br>
        Jabatan
        <br><br><br><br>
        ____________________________<br>
        Nama<br>
        NIP
    </div>
</div>
</body>
</html>
