<?php

namespace App\Http\Controllers\manufacturing_order;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ManufacturingOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use PhpParser\Node\Stmt\Catch_;

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
    private function baseData()
    {
        try {
            return $this->model->selectRaw("manufacturing_orders.id, nama_produk, schedule, late, manufacturing_orders.quantity, billofmaterials.id as bom_id, manufacturing_orders.products_id, manufacturing_orders.status as status")
                                ->join("products", "products.id", "=", "manufacturing_orders.products_id")
                                ->join("billofmaterials", "billofmaterials.id", "=", "manufacturing_orders.billofmaterials_id");
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }
    private function getMoData()
    {
        try {
            return ManufacturingOrder::selectRaw("manufacturing_orders.id, nama_produk, schedule, late, quantity")
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
        $data["id"] = $this->model->getId();
        try {
            return $this->model->insert($data);
        } catch (\Throwable $th) {
            return response()->json("Error as: ".$th->getMessage(), 400);
        }
    }

    public function show($id)
    {
        try {
            $query = $this->baseData()->where("manufacturing_orders.id", "=", $id)->get();
            
            //return response()->json($query, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
    }

    public function edit($id)
    {
        try {
            $query = $this->baseData()->where("manufacturing_orders.id", "=", $id)->first();
            $data = array(
                "mo_data" => $query,
                "data_produk" => Product::get(),
                "data_bom" => DB::table("billofmaterials")->get(),
            );
            return view("manufacturing_order.mo_detail", ["nama" => "manufacturing order", "data" => $data]);
            //return response()->json($query, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 400);
        }
        
    }
    public function onStep($id)
    {
        $mo_data = ManufacturingOrder::find($id);
        $last = $mo_data->status;
        $is_success = false;
        if($mo_data->status == 1)
        {
            if($this->checkBomValidity($mo_data->billofmaterials_id, $mo_data->quantity))
            {
                $bomdetail = DB::table("billofmaterialsdetails")->where("billofmaterials_id", "=", $mo_data->billofmaterials_id)->get();
                foreach ($bomdetail as $key) {
                    $demand = $key->quantity * $mo_data->quantity;
                    if($this->reduceComponent($key->components_id, $demand))
                    {
                        $is_success = true;
                        //store to manufacturing_orders_detail
                    } else{
                        $is_success = false;
                    }
                }
                $mo_data->status = $last + 1;
            } else {
                $mo_data->status = 1;
                return back()->with(["warning" => "Gagal produksi stok kurang"]);
            }
        }
        $mo_data->save();
        return back()->with("berhasil melakukan konfirmasi");
    }
    private function checkBomValidity($billofmaterial_id, $demand)
    {
        $bomdetail = DB::table("billofmaterialsdetails")->where("billofmaterials_id", "=", $billofmaterial_id)->get();
        foreach ($bomdetail as $key) {
            if($this->checkOnHandAvailability($key->components_id, $demand))
            {
                return true;
            } else {
                return false;
            }
        }
    }
    private function checkOnHandAvailability($component_id, $demand)
    {
        $compoent = Component::find($component_id);
        if($compoent->on_hand >= $demand)
        {
            return true;
        } else {
            return false;
        }
    }
    private function reduceComponent($component_id, $demand)
    {
        if($this->checkOnHandAvailability($component_id, $demand))
        {
            $component = Component::find($component_id);
            $component->on_hand = $component->on_hand - $demand;
            $component->save();
            return true;
        } else {
            return false;
        }
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
