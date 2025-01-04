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
        $data = $this->getDataBOM();
        return view("bom/bom", ["nama"=> "bom"], compact('data'));
    }
    private function getDataBOM()
    {
        try {
            $data = BOM::selectRaw("
                        products.nama_produk, 
                        products.internal_reference, billofmaterials.id,
                        (SELECT COUNT(*) FROM `billofmaterialsdetails` WHERE billofmaterials_id =  billofmaterials.id) AS total
                        ")
                        ->join("products", "products.id" , "=", "billofmaterials.products_id")
                        ->get();
            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
        try {
            $data_bom = $request->bom;
            $data_bom["id"] = BOM::getId();
            BOM::insert($data_bom);
            $dt = [];
            foreach ($request->detail as $key) {
                $bod = [
                    "id" => BOMDetail::getId(),
                    "billofmaterials_id" => $data_bom["id"],
                    "components_id" => $key["components_id"],
                    "quantity"=> $key["quantity"],
                    "price" => $key["price"]
                ];
                BOMDetail::insert($bod);
            }
            return response()->json(["status"=>"success"], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
        /*$validate = $request->validate([
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
         }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahan = Component::all();
        $produk = Product::all();
        $kategori = Category::all();

        $bom_data = BOM::find($id);
        $bom_detail = BOMDetail::selectRaw("billofmaterialsdetails.id, billofmaterialsdetails.quantity, billofmaterialsdetails.price, components.nama")->join("components", "components.id", "=", "billofmaterialsdetails.components_id")->where("billofmaterials_id", "=", $id)->get();
        return view("bom/update_bom", ["nama"=> "bom", "bom" => $bom_data, "bom_detail" => $bom_detail, "bahan" => $bahan, "produk" => $produk, "kategori" => $kategori]);
    }
    public function tambahBahan(Request $request)
    {
        try {
            $data = $request->except("_token");
            $data["id"] = BOMDetail::getId();
            BOMDetail::insert($data);
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function hapusBahan($id)
    {
        try {
            BOMDetail::find($id)->delete();
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
        $data = $request->except("_token");
        try {
            $update = BOM::find($id)->update($data);
            return redirect("/bill_material");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        /*$validate = $request->validate([
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
         }*/
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

