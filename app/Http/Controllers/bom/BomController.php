<?php

namespace App\Http\Controllers\bom;

use App\Http\Controllers\Controller;
use App\Models\Bom;
use App\Models\Category;
use App\Models\Component;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bom::all();
        return view("bom/bom", ["nama"=> "bom"], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bahan = Component::all();
        $produk = Product::all();
        $kategori = Category::all();
        return view("bom.tambah_bom", ["nama"=> "bom"], compact('bahan', 'produk', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|string|max:4',
            'products_id',
            'categories_id',
            'quantity' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
        ]);
        Bom::create($validate);
        return redirect()->route('bom.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bom = Bom::findOrFail($id);
        return view("bom.edit", ["nama"=> "bom"], compact('bom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'id' => 'required|string|max:4',
            'products_id',
            'categories_id',
            'quantity' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
        ]);

        $bom = Bom::findOrFail($id);
        $bom->update($validate);
        return redirect()->route('bom.index')->with('success', 'Data berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bom = Bom::findOrFail($id);
        $bom->delete();
        return redirect()->route('bom.index')->with('success', 'Data berhasil dihapus!');
    }
}

