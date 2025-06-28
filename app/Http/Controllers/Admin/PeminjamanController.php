<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Users;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['users', 'buku'])->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function laporan()
    {
        $peminjaman = Peminjaman::with(['users', 'buku'])->get();
        return view('admin.peminjaman.laporan', compact('peminjaman'));
    }

    public function create()
    {
        $users = Users::where('role', 'anggota')->get();
        $buku = Buku::where('jumlah', '>', 0)->get(); // hanya buku dengan stok > 0
        return view('admin.peminjaman.create', compact('users', 'buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'buku_id' => 'required|array',
            'buku_id.*' => 'exists:buku,id',
            'jumlah_peminjaman' => 'required|array',
            'jumlah_peminjaman.*' => 'integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

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
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil disimpan');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = Users::where('role', 'anggota')->get();
        $buku = Buku::where('jumlah', '>', 0)->get(); // hanya buku dengan stok > 0
        return view(
            'admin.peminjaman.edit',
            compact('peminjaman', 'users', 'buku')
        );
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_buku' => 'required|exists:buku,id',
            'jumlah_peminjaman' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

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
            $selisih =
                $validated['jumlah_peminjaman'] -
                $peminjaman->jumlah_peminjaman;
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
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate');
    }

    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Ubah status konfirmasi menjadi 1
        $peminjaman->konfirmasi = 1;
        $peminjaman->save();

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dikonfirmasi');
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
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus');
    }
}
