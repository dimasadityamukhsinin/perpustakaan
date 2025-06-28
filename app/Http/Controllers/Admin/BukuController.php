<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\RakBuku;
use App\Models\KategoriBuku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('admin.buku.index', compact('buku'));
    }

    public function laporan()
    {
        $buku = Buku::all();
        return view('admin.buku.laporan', compact('buku'));
    }

    public function create()
    {
        $rak = RakBuku::all();
        $kategori = KategoriBuku::all();
        return view('admin.buku.create', compact('rak', 'kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_rak' => 'required|exists:rak_buku,id',
            'id_kategori_buku' => 'required|exists:kategori_buku,id',
            'judul' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'tahun' => 'required|digits:4|integer',
            'isbn' => 'required|max:255',
            'jumlah' => 'required|integer|min:0'
        ]);

        Buku::create($validated);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $rak = RakBuku::all();
        $kategori = KategoriBuku::all();
        return view('admin.buku.edit', compact('buku', 'rak', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'id_rak' => 'required|exists:rak_buku,id',
            'id_kategori_buku' => 'required|exists:kategori_buku,id',
            'judul' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'tahun' => 'required|digits:4|integer',
            'isbn' => 'required|max:255',
            'jumlah' => 'required|integer|min:0'
        ]);

        $buku->update($validated);
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
