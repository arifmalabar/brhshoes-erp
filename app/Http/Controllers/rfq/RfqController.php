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
        return view("purchase.tambahrfq", ["nama" => "rfq"], compact('bahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|string|max:100',
            'tgl_pesan' => 'required|date',
            'produk.*.components_id' => 'required|string|max:100',
            'produk.*.kuantitas' => 'required|integer|min:1',
            'produk.*.subtotal' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Simpan data ke tabel RFQs
            $kodeRFQ = RFQ::getKodeRFQ();
            $rfq = RFQ::create([
                'id' => $kodeRFQ,
                'kode' => $kodeRFQ,
                'vendor_id' => $request->vendor_id,
                'tgl_pesan' => $request->tgl_pesan,
            ]);

            // Simpan data ke tabel detail RFQs
            foreach ($request->produk as $produk) {
                DetailRFQ::create([
                    'id' => Str::uuid()->toString(),
                    'rfqs_id' => $rfq->id,
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

    public function edit($id)
    {
        $rfq = RFQ::findOrFail($id);
        $bahan = DataBahan::all();
        return view('purchase.editrfq', ["nama" => "rfq"],compact('rfq', 'bahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:100',
            'vendor_id' => 'required|string|max:100',
            'tgl_pesan' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $rfq = RFQ::findOrFail($id);
            $rfq->update([
                'kode' => $request->kode,
                'vendor_id' => $request->vendor_id,
                'tgl_pesan' => $request->tgl_pesan,
            ]);

            if ($request->produk) {
                foreach ($request->produk as $produk) {
                    DetailRFQ::where('id', $produk['id'])->update([
                        'components_id' => $produk['components_id'],
                        'kuantitas' => $produk['kuantitas'],
                        'subtotal' => $produk['subtotal'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('rfq.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
{
    try {
        $rfq = RFQ::findOrFail($id);
        $rfq->delete();
        DetailRFQ::where('rfqs_id', $id)->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}

}