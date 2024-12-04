<?php

namespace App\Http\Controllers\Bahan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component;

class BahanController extends Controller
{

    public function index()
    {
        $data = Component::all();
        return view('bahan.bahan', compact('data'))->with('nama', 'bahan');
    }


    public function create()
    {
        return view('bahan.tambah')->with('nama', 'bahan');
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1|max:4294967295',
            'harga_modal' => 'required|integer|min:0|max:4294967295',
            'jenis_bahan' => 'required|string|max:255',
        ]);

        try {

            Component::create($validated);
            return redirect()->route('bahan.index')->with('success', 'Bahan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal menyimpan data: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {

        $bahan = Component::findOrFail($id);
        return view('bahan.edit', compact('bahan'))->with('nama', 'bahan');
    }


    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1|max:4294967295',
            'harga_modal' => 'required|integer|min:0|max:4294967295',
            'jenis_bahan' => 'required|string|max:255',
        ]);

        try {

            $bahan = Component::findOrFail($id);
            $bahan->update($validated);

            return redirect()->route('bahan.index')->with('success', 'Bahan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal memperbarui data: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            
            $bahan = Component::findOrFail($id);
            $bahan->delete();

            return redirect()->route('bahan.index')->with('success', 'Bahan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
