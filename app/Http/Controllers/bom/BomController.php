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
        return view("bom/bom", ["nama"=> "bom"]);
    }

    public function getKategori(){
        try {
            $model= Category::getCategoryData();
            return $model;
        }catch (\Throwable $th){
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
        }
    }

    public function getComponent(){
        try {
            $model = Component::getComponentData();
            return $model;
        }catch (\Throwable $th){
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
        }
    }

    public function getProduk(){
        try {
            $model = Product::getProduct();
            return $model;
        }catch (\Throwable $th){
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("bom/tambah_bom", ["nama"=> "bom"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $query = Bom::insert($data);
            if($query)
            {
                return response()->json(["status" => "success"], 200);
            } else {
                throw new Exception("Gagal menambah data");
            }
        } catch (\Throwable $th){
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
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
        try {
            $query = Bom::find($id);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("bom/update_bom", ["nama"=> "bom"]);
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
        $data = $request->all();
        try {
            $query = Bom::find($id)->update($data);
            if($query)
            {
                return response()->json(["status" => "success"], 200);
            } else {
                throw new Exception("Gagal merubah data", 1);
            }
        } catch (\Throwable $th) {
            return response()->json(["status" => "error", "message" => $th->getMessage()], 401);
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
        try {
            $query = Bom::where("id", "=", $id)->delete();
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

