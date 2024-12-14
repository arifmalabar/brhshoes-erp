<?php

namespace App\Http\Controllers\produk;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Produk;
use Illuminate\Http\Request;

use Exception;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->model = new Product();
    }
    public function index()
    {
        
        return view("produk/produk", ["nama"=> "manufacturing", "data" => $this->getData()]);
    }
    public function getKategori()
    {
        try {
            $model = Category::getCategoryData();
            return $model;
        } catch (\Throwable $th) {
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
        }
    }
    public function getProductData()
    {
        return $this->getData();
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("produk/tambah", ["nama"=> "produk"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(["nama_produk", "harga_modal", "harga_jual", "internal_reference"]);
        try {
            $query = Product::insert($data);
            return back()->with("success", "Berhasil menambah data");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $query = Product::find($id);
            if(!($query->count() == 0))
            {
                return response()->json(["status" => "success", "data" => $query], 200);
            } else{
                return response()->json(["status" => "error", "message" => "data tidak ditemukan"], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(["status" => "error", "message" => $th->getMessage()], 500);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("produk/update_produk", ["nama"=> "produk"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(["nama_produk", "harga_modal", "harga_jual", "internal_reference"]);
        try {
            $query = Product::find($id)->update($data);
            return back()->with("success", "Berhasil mengubah data");
        } catch (\Throwable $th) {
            return $th->getMessage();
            //return back()->with("error", "gagal mengubah data ".$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $query = Product::where("product_id", "=", $id)->delete();
            if($query)
            {
                return response()->json(["status" => "success"], 200);
            } else {
                throw new Exception("Gagal menghapus data data", 1);
            }
        } catch (\Throwable $th) {
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
        }
    }
}
