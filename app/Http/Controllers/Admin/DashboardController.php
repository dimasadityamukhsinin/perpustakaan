<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian; // kalau pengembalian tabel sendiri

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPeminjaman = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();

        return view('admin.dashboard', compact('totalBuku', 'totalAnggota', 'totalPeminjaman', 'totalPengembalian'));
    }
}
