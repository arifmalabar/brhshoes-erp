<?php

namespace App\Http\Controllers\manufacturing_order;

use App\Http\Controllers\Controller;
use App\Models\Component;
use App\Models\ManufacturingOrder;
use App\Models\ManufacturingOrderDetail;
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
            return ManufacturingOrder::selectRaw("manufacturing_orders.id, nama_produk, schedule, late, quantity, status")
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
        $mo_data = ManufacturingOrder::selectRaw("manufacturing_orders.id as id, billofmaterialsdetails.quantity * manufacturing_orders.quantity as demand, components.on_hand as on_hand, components.id as component_id, billofmaterials.id as bom_id")
                                    ->join("billofmaterials", "billofmaterials.id", "=", "manufacturing_orders.billofmaterials_id")
                                    ->join("billofmaterialsdetails", "billofmaterialsdetails.billofmaterials_id", "=", "billofmaterials.id")
                                    ->rightJoin("components", "components.id", "=", "billofmaterialsdetails.components_id")                    
                                    ->where("manufacturing_orders.id", '=', $id)
                                    ->get();
        $available = 0;
        $notavailable = 0;
        $mo_id="";
        foreach ($mo_data as $key) {
            if($key->on_hand <= $key->demand)
            {
                $notavailable++;
            } else {
                $available++;
            }
            $mo_id = $key->id;
        }
        $mo = ManufacturingOrder::find($mo_id);
        if($notavailable == 0 && $mo->status == 1)
        {
            $mo->status = $mo->status + 1;
            $mo->save();
            foreach ($mo_data as $key) {
                $component = Component::find($key->component_id);
                $mo_data = [
                    "manufacturingorders_id" => $mo_id,
                    "billofmaterialdetails_id" => $key->bom_id,
                    "needed" => $key->demand,
                    "served" => $component->on_hand,
                    "used" => ($component->on_hand - $key->demand)
                ];
                ManufacturingOrderDetail::insert($mo_data);
                $component->on_hand = $component->on_hand - $key->demand;
                $component->save();
            }
            return back()->with(["success" => "berhasil melakukan produksi"]);
        } else if ($mo->status == 0){
            $mo->status = $mo->status + 1;
            $mo->save();
            return back()->with(["success" => "berhasil konfirmasi"]);
        } else {
            return back()->with(["warning" => "gagal melakukan produksi"]);
        }
        
    }
    public function showDetailMo($mo_id)
    {
        try {
            $modata = ManufacturingOrderDetail::where("manufacturingorders_id", "=", $mo_id)
                                                ->get();
            return $modata;
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 400);
        }
    }
    private function checkBomValidity($billofmaterial_id, $demand)
    {
        echo $demand."<br>";
        
        //return $available <= $notavailable ? "kosong" : "tersedia";
        /*
        if($available >= $notavailable)
        {
            return back()->with(["warning" => "stok tidak memadahi"]);
        }*/
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
    private function storeMoDetails($data)
    {
        try {
            DB::table("manufacturing_order_details")->insert($data);
        } catch (\Throwable $th) {
            return back()->with(["warning" => "Gagal menambah data detail MO"]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            ManufacturingOrder::find($id)->update($data);
            return back()->with("success", "berhasil mengubah data");
        } catch (\Throwable $th) {
            return back()->with("error", "gagal mengubah data ".$th->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            ManufacturingOrder::find($id)->delete();
            return back()->with("success", "berhasil mengahpus data");
        } catch (\Throwable $th) {
            return back()->with("error", "gagal menghapus data ".$th->getMessage());
        }
    }
}
