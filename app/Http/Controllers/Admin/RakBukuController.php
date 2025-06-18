<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RakBuku;

class RakBukuController extends Controller
{
    public function index()
    {
        $rak = RakBuku::all();
        return view('admin.rak_buku.index', compact('rak'));
    }

    public function create()
    {
        return view('admin.rak_buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ]);

        RakBuku::create($request->all());
        return redirect()->route('admin.rak_buku.index')->with('success', 'Rak Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rak = RakBuku::findOrFail($id);
        return view('admin.rak_buku.edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
        ]);

        $rak = RakBuku::findOrFail($id);
        $rak->update($request->all());

        return redirect()->route('admin.rak_buku.index')->with('success', 'Rak Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $rak = RakBuku::findOrFail($id);
        $rak->delete();

        return redirect()->route('admin.rak_buku.index')->with('success', 'Rak Buku berhasil dihapus');
    }
}
