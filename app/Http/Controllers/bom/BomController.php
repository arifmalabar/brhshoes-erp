<?php

namespace App\Http\Controllers\bom;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Bom;
use App\Models\BOMDetail;
use App\Models\Category;
use App\Models\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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

        try {
            $kodeBOM = Bom::getId();
            $bom = Bom::create([
             'id' => $kodeBOM,
             'products_id' => $request->products_id,
             'categories_id' => $request->categories_id,
             'quantity' => $request->quantity,
             'satuan' => $request->satuan,
            ]);
 
            foreach($request->produk as $produk){
                BOMDetail::create([
                    'id' => Str::uuid()->toString(),
                    'components_id' => $produk['components_id'],
                    'quantity' =>$produk['quantity'],
                    'price' =>$produk['price'],
                ]);
                DB::commit();
                return redirect()->route('bom.index')->with('success', 'Data berhasil disimpan!');
            }
         }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
         }
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

        try {
            $kodeBOM = Bom::getId();
            $bom = Bom::findOrFail($id);
            $bom->update([
             'id' => $kodeBOM,
             'products_id' => $request->products_id,
             'categories_id' => $request->categories_id,
             'quantity' => $request->quantity,
             'satuan' => $request->satuan,
            ]);
 
            foreach($request->produk as $produk){
                BOMDetail::create([
                    'id' => Str::uuid()->toString(),
                    'components_id' => $produk['components_id'],
                    'quantity' =>$produk['quantity'],
                    'price' =>$produk['price'],
                ]);
                DB::commit();
                return redirect()->route('bom.index')->with('success', 'Data berhasil disimpan!');
            }
         }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
         }
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

