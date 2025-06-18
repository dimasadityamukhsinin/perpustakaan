<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController
{
    public function index()
    {
        $idUser = auth()->id();
    
        $pengembalian = Pengembalian::with(['peminjaman' => function ($query) use ($idUser) {
            $query->where('id_user', $idUser);
        }])->whereHas('peminjaman', function ($query) use ($idUser) {
            $query->where('id_user', $idUser);
        })->get();    
        return view('anggota.pengembalian.index', compact('pengembalian'));
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

        $peminjaman = Peminjaman::find($validated['id_peminjaman']);

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

        Pengembalian::create($validated);

        return redirect()
            ->route('anggota.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.users', 'peminjaman.buku')->findOrFail($id);
        $peminjaman = Peminjaman::all();
        return view(
            'anggota.pengembalian.edit',
            compact('pengembalian', 'peminjaman')
        );
    }

    public function kembalikanForm($id)
    {
        $peminjaman = Peminjaman::with('users', 'buku')->findOrFail($id);
        return view('anggota.pengembalian.kembalikan', compact('peminjaman'));
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

        $pengembalian->update($validated);
        return redirect()
            ->route('anggota.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()
            ->route('anggota.pengembalian.index')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
}
