<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\VendorCompany;
use App\Models\VendorIndividu;
use Illuminate\Support\Facades\DB;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;
    public Component $component;
    public PurchaseOrderDetail $detail;
    public function __construct() {
        $this->path = "purchase_order/";
        $this->component = new Component();
        $this->detail = new PurchaseOrderDetail();
    }
    public function order()
    {
        $purchases = PurchaseOrder::all(); // Get all purchase orders
        $vendorsCompany = VendorCompany::all();
        $vendorsIndividu = VendorIndividu::all();
        $rfq = DB::table("rfqs")->get();
        $vendors = $vendorsIndividu->merge($vendorsCompany);
        return view($this->path."purchaseorder", ["nama" => "Purchaseorder", "purchases" => $purchases, "vendors" => $vendors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(["kode", "_token"]);
        $data["kode"] = PurchaseOrder::getKode();
        PurchaseOrder::insert($data);
        return redirect()->route('purchaseorder')->with('success', 'Purchase order created successfully!');
        
    }

    public function validasi($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->first();
        switch ($purchases->status) {
            case 0:
                    return $this->validasiPage($kode, $purchases);
                break;
            case 1:
                    return $this->bayar($kode);
                break;
            case 2:
                    return $this->konfirmasi($kode);
                break;
            case 3:
                    return $this->selesai($kode);
                break;
            default:
                    return redirect("/purchase/order");
                break;
        }
    }
    
    public function validasiPage($kode, PurchaseOrder $purchases)
    {
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        /*if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }*/
        return view($this->path.'purchase_validasi', [
            "nama" => "Purchasevalidasi",
            "purchases" => $purchases,
            "bahan" => $this->component->get(),
            "detail" => $this->detail->getPoDetail($kode),
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima,
        ]);
    }
    public function tambahBahan(Request $request)
    {
        $data = $request->except("_token");
        $kodeComponent = $request->component_id;
        try {
            $component = Component::find($kodeComponent);
            $data["harga_satuan"] = $component->harga_modal;
            $data["subtotal"] = $component->harga_modal * $request->kuantitas;
            $data["diterima"] = 0;
            $po = PurchaseOrder::find($request->purchase_order_id);
            $po->total += $component->harga_modal * $request->kuantitas;
            $po->save();
            PurchaseOrderDetail::insert($data);
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function bayar($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->first();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();

        return view($this->path.'purchase_bayar', [
            "nama" => "purchase_bayar",
            "purchases" => $purchases,
            "bahan" => $this->component->get(),
            "detail" => $this->detail->getPoDetail($kode),
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
        ]);
    }

    public function konfirmasi($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->first();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        

        return view($this->path.'purchase_konfirmasi', [
            "nama" => "purchase_konfirmasi",
            "purchases" => $purchases,
            "bahan" => $this->component->get(),
            "detail" => $this->detail->getPoDetail($kode),
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
        ]);
    }

    public function selesai($kode)
    {
        // Ambil purchase order berdasarkan kode
        $purchases = PurchaseOrder::where('kode', $kode)->first();

        // Pastikan ada purchase order yang ditemukan
        

        // Update status untuk setiap purchase order
        /*foreach ($purchases as $purchase) {
            $purchase->status = 'Tagihan Selesai';
            $purchase->save();  // Simpan perubahan status
        }*/

        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();

        return view($this->path.'purchase_selesai', [
            "nama" => "purchase_selesai",
            "purchases" => $purchases,
            "bahan" => $this->component->get(),
            "detail" => $this->detail->getPoDetail($kode),
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
        ]);
    }
    public function updateTanggalDiterima(Request $request)
    {
        $kode = $request->kode;
        $tgl_diterima = $request->tanggal_diterima;
        try {
            $po = PurchaseOrder::find($kode);
            $po->tanggal_diterima = $tgl_diterima;
            if($po->status == 2)
            {
                $metode_bayar = $request->metode_pembayaran;
                $po->metode_pembayaran = $metode_bayar;
                //ubah detail
                $this->terimaBahan($kode);
            }
            $po->status = $po->status + 1;
            $po->save();
            return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        // Validasi inpu
        /*$request->validate([
            'tanggal_diterima' => 'required|date',
        ]);

        // Ambil data yang sesuai (misalnya berdasarkan kode atau id)
        $purchase = PurchaseOrder::find(1); // Ganti dengan pencarian sesuai kondisi Anda
        if ($purchase) {
            // Update tanggal diterima
            $purchase->tanggal_diterima = $request->tanggal_diterima;
            $purchase->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);*/
    }
    private function terimaBahan($kode) 
    {   
        $po_details = PurchaseOrderDetail::where("purchase_order_id", "=", $kode);
        foreach ($po_details->get() as $key) {
            $key->diterima = $key->kuantitas;
            $fix_podetail = [
                "purchase_order_id" => $key->purchase_order_id,
                "component_id" => $key->component_id,
                "kuantitas" => $key->kuantitas,
                "diterima" => $key->kuantitas,
                "harga_satuan" => $key->harga_satuan,
                "subtotal" => $key->subtotal,
                "deskripsi" => $key->deskripsi
            ];
            PurchaseOrderDetail::where("purchase_order_id",  $kode)->update($fix_podetail);
            $component = Component::find($key->component_id);
            $component->on_hand += $key->kuantitas;
            $component->save(); 
        }
    }
}
