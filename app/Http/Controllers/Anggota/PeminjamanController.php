<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Users;
use App\Models\Buku;

class PeminjamanController
{
    public function index()
    {
        $idUser = auth()->id();

        $peminjaman = Peminjaman::with(['users', 'buku'])
            ->where('id_user', $idUser)
            ->get();
        return view('anggota.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $users = Users::where('role', 'anggota')->get();
        $buku = Buku::where('jumlah', '>', 0)->get(); // hanya buku dengan stok > 0
        return view('anggota.peminjaman.create', compact('users', 'buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|array',
            'buku_id.*' => 'exists:buku,id',
            'jumlah_peminjaman' => 'required|array',
            'jumlah_peminjaman.*' => 'integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $validated['id_user'] = auth()->id();

        foreach ($validated['buku_id'] as $index => $buku_id) {
            $jumlah = $validated['jumlah_peminjaman'][$index];

            $buku = Buku::find($buku_id);

            if ($buku && $buku->jumlah >= $jumlah) {
                Peminjaman::create([
                    'id_user' => $validated['id_user'],
                    'id_buku' => $buku_id,
                    'jumlah_peminjaman' => $jumlah,
                    'tanggal_pinjam' => $validated['tanggal_pinjam'],
                    'tanggal_kembali' => $validated['tanggal_kembali'],
                    'konfirmasi' => 0,
                ]);

                $buku->decrement('jumlah', $jumlah);
            } else {
                return back()
                    ->withErrors(['Buku tidak mencukupi stok'])
                    ->withInput();
            }
        }

        return redirect()
            ->route('anggota.peminjaman.index')
            ->with('success', 'Peminjaman berhasil disimpan');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = Users::where('role', 'anggota')->get();
        $buku = Buku::where('jumlah', '>', 0)->get(); // hanya buku dengan stok > 0
        return view(
            'anggota.peminjaman.edit',
            compact('peminjaman', 'users', 'buku')
        );
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
    
        $validated = $request->validate([
            'id_buku' => 'required|exists:buku,id',
            'jumlah_peminjaman' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $validated['id_user'] = auth()->id(); // ambil id user dari session (user yg login)
    
        $bukuLama = Buku::find($peminjaman->id_buku);
        $bukuBaru = Buku::find($validated['id_buku']);
    
        if ($validated['id_buku'] != $peminjaman->id_buku) {
            // Kalau bukunya ganti
            if ($bukuLama) {
                $bukuLama->increment('jumlah', $peminjaman->jumlah_peminjaman);
            }
            if ($bukuBaru) {
                $bukuBaru->decrement('jumlah', $validated['jumlah_peminjaman']);
            }
        } else {
            // Bukunya sama, cek jumlahnya
            $selisih = $validated['jumlah_peminjaman'] - $peminjaman->jumlah_peminjaman;
            if ($selisih > 0) {
                // Tambah peminjaman, kurangi stok
                $bukuBaru->decrement('jumlah', $selisih);
            } elseif ($selisih < 0) {
                // Kurangi peminjaman, tambahkan stok
                $bukuBaru->increment('jumlah', abs($selisih));
            }
            // Kalau selisih = 0, tidak perlu apa-apa
        }
    
        $peminjaman->update($validated);
    
        return redirect()
            ->route('anggota.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate dan stok buku disesuaikan');
    }    

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Pastikan ambil jumlah pinjamannya yang benar
        $jumlahPinjam = (int) $peminjaman->jumlah_peminjaman; // ubah jadi integer untuk aman

        $buku = Buku::find($peminjaman->id_buku);

        if ($buku && $jumlahPinjam > 0) {
            $buku->increment('jumlah', $jumlahPinjam);
        }
    
        $peminjaman->delete();

        return redirect()
            ->route('anggota.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus');
    }
}
