<?php

namespace App\Http\Controllers\PO;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Http\Controllers\Controller;

class purchaseOrderController extends Controller
{
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
        $purchases = PurchaseOrder::where('kode', $kode)->get();
        // Ambil tanggal yang unik
        $tanggalPesan = PurchaseOrder::select('tanggal_pesan')->distinct()->get();
        $tanggalDiterima = PurchaseOrder::select('tanggal_diterima')->distinct()->get();
        if ($purchases->isEmpty()) {
            return redirect()->back()->with('error', 'Data dengan kode tersebut tidak ditemukan.');
        }

        return view('purchase_validasi', [
            "nama" => "Purchasevalidasi",
            "purchases" => $purchases,
            "tanggalPesan" => $tanggalPesan,
            "tanggalDiterima" => $tanggalDiterima
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
    // Validasi input
    $request->validate([
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

    return response()->json(['success' => false]);
}
}