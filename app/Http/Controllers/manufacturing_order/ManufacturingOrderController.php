<?php

namespace App\Http\Controllers\manufacturing_order;

use App\Http\Controllers\Controller;
use App\Models\ManufacturingOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ManufacturingOrderController extends Controller
{
    public function __construct() {
        $this->model = new ManufacturingOrder();
    }

    public function index()
    {
        $data = array(
            "mo_data" => $this->getMoData(),
        );
        return view("manufacturing_order.manufacturing_order", ["nama" => "manufacturing order", "data"  => $data]);
    }
    private function getMoData()
    {
        try {
            return $this->model
                        ->join("products", "products.id", "=", "manufacturing_orders.products_id")
                        
                        ->get();
            
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function create()
    {
        return view("manufacturing_order.tambah_mo", ["nama" => "manufacturing order"]);
    }
    public function getProductData()
    {
        return Product::getProduct();
    }
    public function getBomData($id)
    {
        try {
            return DB::table("billofmaterials")->where("products_id", "=", $id)->get();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }
    public function getDetailBom($id)
    {
        try {
            return DB::table("billofmaterialsdetails")
                    ->join("components", "components.id", "=", "billofmaterialsdetails.components_id")
                    ->where("billofmaterials_id", "=", $id)
                    ->get();
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        return $this->insertData($data);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view("manufacturing_order.mo_detail", ["nama" => "manufacturing order", "data" => $this->findData($id)]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        return $this->updateData($id, $data);
    }
    public function destroy($id)
    {
        return $this->deleteData($id);
    }
}
