<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriBuku;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategori = KategoriBuku::all();
        return view('admin.kategori_buku.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori_buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ]);

        KategoriBuku::create($request->all());
        return redirect()->route('admin.kategori_buku.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        return view('admin.kategori_buku.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ]);

        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('admin.kategori_buku.index')->with('success', 'Kategori Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori_buku.index')->with('success', 'Kategori Buku berhasil dihapus');
    }
}
