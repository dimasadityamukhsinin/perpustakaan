<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian; // kalau pengembalian tabel sendiri

class DashboardController
{
    public function index()
    {
        $idUser = auth()->id();

        $totalPeminjaman = Peminjaman::where('id_user', $idUser)->count();
        $totalPengembalian = Pengembalian::whereHas('peminjaman', function (
            $query
        ) use ($idUser) {
            $query->where('id_user', $idUser);
        })->count();

        return view(
            'anggota.dashboard',
            compact(
                'totalPeminjaman',
                'totalPengembalian'
            )
        );
    }
}
