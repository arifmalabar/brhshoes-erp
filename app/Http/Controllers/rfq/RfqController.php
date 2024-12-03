<?php

namespace App\Http\Controllers\rfq;

use App\Models\RFQ;
use App\Models\DataBahan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RfqController extends Controller
{
    public function index()
    {
        return view("purchase.rfq", ["nama" => "rfq"]);
    }

    public function create()
    {
        $bahan = DataBahan::all();
        return view("purchase.tambahrfq",["nama" => "rfq"], compact('bahan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10',
            'tgl_pesan' => 'required|date',
            'vendor' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
        ]);
        RFQ::create($validated);
        return redirect()->route('rfq.index')->with('success', 'Data RFQ berhasil ditambahkan!');
    }
}