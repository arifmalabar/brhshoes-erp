<?php

namespace App\Http\Controllers\rfq;

use Illuminate\Support\Str;
use App\Models\RFQ;
use App\Models\DataBahan;
use App\Models\DetailRFQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RfqController extends Controller
{
    public function index()
    {
        $RFQ = Rfq::all();
        return view("purchase.rfq", ["nama" => "rfq"], compact('RFQ'));
    }

    public function create()
    {
        $bahan = DataBahan::all();
        return view("purchase.tambahrfq",["nama" => "rfq"], compact('bahan'));
    }
    public function store(Request $request)
    {
    /*$request->validate([
        'kode' => 'required|string|max:100',
        'vendor_id' => 'required|string|max:100',
        'tgl_pesan' => 'required|date',
        'produk.*.components_id' => 'required|string|max:100',
        'produk.*.kuantitas' => 'required|integer|min:1',
        'produk.*.subtotal' => 'required|integer|min:0',
    ]);*/

    DB::beginTransaction();
    try {
        // Simpan data ke tabel rfqs
        $rfq = RFQ::create([
            'id' => RFQ::getKodeRFQ(),
            'kode' => $request->kode,
            'vendor_id' => $request->vendor_id,
            'tgl_pesan' => $request->tgl_pesan,
        ]);

        // Simpan data ke tabel detail_rfqs
        foreach ($request->produk as $produk) {
            DetailRFQ::create([
                'id' => Str::uuid()->toString(),
                'rfqs_id' => RFQ::getKodeRFQ(),
                'components_id' => $produk['components_id'],
                'kuantitas' => $produk['kuantitas'],
                'subtotal' => $produk['subtotal'],
            ]);
        }

        DB::commit();

        return redirect()->route('rfq.index')->with('success', 'Data berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}