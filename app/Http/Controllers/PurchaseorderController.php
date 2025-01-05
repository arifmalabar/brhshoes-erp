<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\VendorCompany;
use App\Models\VendorIndividu;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $purchases = PurchaseOrder::all(); // Get all purchase orders
        $vendorsCompany = VendorCompany::all();
        $vendorsIndividu = VendorIndividu::all();
        $vendors = $vendorsIndividu->merge($vendorsCompany);
        return view("purchaseorder", ["nama" => "Purchaseorder", "purchases" => $purchases, "vendors" => $vendors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'kode' => 'required|string|max:10',
            'tanggal_pesan' => 'required|date',
            'vendor' => 'required|string|max:255',
            'total' => 'required|numeric',
            'status' => 'required|string|max:255',
            'tanggal_diterima' => 'string|date',
        ]);

        // Create a new purchase order record
        PurchaseOrder::create($request->all());

        return redirect()->route('purchaseorder')->with('success', 'Purchase order created successfully!');
    }

    public function validasi($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->first();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        /*if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }*/
        return view('purchase_validasi', [
            "nama" => "Purchasevalidasi",
            "purchases" => $purchases,
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima,
        ]);
    }
    

    public function bayar($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->get();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }

        return view('purchase_bayar', [
            "nama" => "purchase_bayar",
            "purchases" => $purchases,
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
        ]);
    }

    public function konfirmasi($kode)
    {
        $purchases = PurchaseOrder::where('kode', $kode)->get();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }

        return view('purchase_konfirmasi', [
            "nama" => "purchase_konfirmasi",
            "purchases" => $purchases,
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
        ]);
    }

    public function selesai($kode)
    {
        // Ambil purchase order berdasarkan kode
        $purchases = PurchaseOrder::where('kode', $kode)->get();

        // Pastikan ada purchase order yang ditemukan
        if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }

        // Update status untuk setiap purchase order
        foreach ($purchases as $purchase) {
            $purchase->status = 'Tagihan Selesai';
            $purchase->save();  // Simpan perubahan status
        }

        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();

        return view('purchase_selesai', [
            "nama" => "purchase_selesai",
            "purchases" => $purchases,
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
}
