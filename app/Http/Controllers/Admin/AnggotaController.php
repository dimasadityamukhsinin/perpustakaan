<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Users::where('role', 'anggota')->get();
        return view('admin.anggota.index', compact('anggotas'));
    }

    public function laporan()
    {
        $anggotas = Users::where('role', 'anggota')->get();
        return view('admin.anggota.laporan', compact('anggotas'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'anggota';

        Users::create($validated);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $anggota = Users::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $anggota = Users::findOrFail($id);
        $anggota->update($validated);
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diupdate');
    }
    
    public function editPassword($id)
    {
        $anggota = Users::findOrFail($id);
        return view('admin.anggota.edit_password', compact('anggota'));
    }

    public function updatePassword(Request $request, $id)
    {
        $anggota = Users::findOrFail($id);
    
        $validated = $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        $anggota->update([
            'password' => Hash::make($validated['password'])
        ]);
    
        return redirect()->route('admin.anggota.index')->with('success', 'Password berhasil diubah');
    }

    public function destroy($id)
    {
        $anggota = Users::findOrFail($id);
        $anggota->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
}
