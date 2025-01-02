<?php

namespace App\Http\Controllers;

use App\Models\VendorIndividu;
use Illuminate\Http\Request;

class VendorIndividuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function individu()
    {
        $vendors = VendorIndividu::all(); // Get all vendors
        return view("vendor.individu", ["nama" => "vendor", "vendors" => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // Create a new vendor record
        VendorIndividu::create([
            'kode' => $request->kode,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('vendor')->with('success', 'Vendor created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorIndividu  $vendorIndividu
     * @return \Illuminate\Http\Response
     */
    public function show(VendorIndividu $vendorIndividu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorIndividu  $vendorIndividu
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorIndividu $vendorIndividu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorIndividu  $vendorIndividu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        // Find the vendor by ID
        $vendor = VendorIndividu::findOrFail($kode);

        // Validate the request data
        $request->validate([
            'kode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // Update the vendor record
        $vendor->update([
            'kode' => $request->kode,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('vendor')->with('success', 'Vendor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorIndividu  $vendorIndividu
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        // Mengambil data vendor berdasarkan kode
        $vendor = VendorIndividu::where('kode', $kode)->firstOrFail();
    
        // Menghapus vendor
        $vendor->delete();
    
        return redirect()->route('vendor')->with('success', 'Vendor deleted successfully!');
    }
}
