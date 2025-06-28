<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Buku;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman')->get();
        return view('admin.pengembalian.index', compact('pengembalian'));
    }

    public function laporan()
    {
        $pengembalian = Pengembalian::with('peminjaman')->get();
        return view('admin.pengembalian.laporan', compact('pengembalian'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'jumlah_pengembalian' => 'required|integer|min:1',
            'tanggal_dikembalikan' => 'required|date',
            'kondisi_buku' => 'required|max:255',
            'denda' => 'required|integer|min:0',
        ]);

        $peminjaman = Peminjaman::findOrFail($validated['id_peminjaman']);

        if (
            $validated['jumlah_pengembalian'] > $peminjaman->jumlah_peminjaman
        ) {
            return back()
                ->withErrors([
                    'jumlah_pengembalian' =>
                        'Jumlah pengembalian melebihi jumlah peminjaman',
                ])
                ->withInput();
        }

        // Tambahkan jumlah buku ke tabel buku
        $buku = Buku::find($peminjaman->id_buku);
        if ($buku) {
            $buku->increment('jumlah', $validated['jumlah_pengembalian']);
        }

        // Simpan data pengembalian
        Pengembalian::create($validated);

        return redirect()
            ->route('admin.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengembalian = Pengembalian::with(
            'peminjaman.users',
            'peminjaman.buku'
        )->findOrFail($id);
        $peminjaman = Peminjaman::all();
        return view(
            'admin.pengembalian.edit',
            compact('pengembalian', 'peminjaman')
        );
    }

    public function kembalikanForm($id)
    {
        $peminjaman = Peminjaman::with('users', 'buku')->findOrFail($id);
        return view('admin.pengembalian.kembalikan', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $validated = $request->validate([
            'id_peminjaman' => 'required|exists:peminjaman,id',
            'jumlah_pengembalian' => 'required|integer|min:1',
            'tanggal_dikembalikan' => 'required|date',
            'kondisi_buku' => 'required|max:255',
            'denda' => 'required|integer|min:0',
        ]);

        $peminjaman = Peminjaman::findOrFail($validated['id_peminjaman']);

        if (
            $validated['jumlah_pengembalian'] > $peminjaman->jumlah_peminjaman
        ) {
            return back()
                ->withErrors([
                    'jumlah_pengembalian' =>
                        'Jumlah pengembalian melebihi jumlah peminjaman',
                ])
                ->withInput();
        }

        // Hitung selisih jumlah pengembalian
        $selisih =
            $validated['jumlah_pengembalian'] -
            $pengembalian->jumlah_pengembalian;

        if ($selisih != 0) {
            $buku = Buku::find($peminjaman->id_buku);
            if ($buku) {
                $buku->increment('jumlah', $selisih);
            }
        }

        // Update data pengembalian
        $pengembalian->update($validated);

        return redirect()
            ->route('admin.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()
            ->route('admin.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}
