<?php

namespace App\Http\Controllers;

use App\Models\VendorCompany;
use Illuminate\Http\Request;

class VendorCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function company()
    {
        $vendors = VendorCompany::all(); // Get all vendors
        return view("vendor.company", ["nama" => "vendorcompany", "vendors" => $vendors]);
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
            'website' => 'required|string|max:255',
        ]);

        // Create a new vendor record
        VendorCompany::create([
            'kode' => $request->kode,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'website' => $request->website,
        ]);

        return redirect()->route('vendorcompany')->with('success', 'Vendor created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorCompany  $VendorCompany
     * @return \Illuminate\Http\Response
     */
    public function show(VendorCompany $VendorCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorCompany  $VendorCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorCompany $VendorCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorCompany  $VendorCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        // Find the vendor by ID
        $vendor = VendorCompany::findOrFail($kode);

        // Validate the request data
        $request->validate([
            'kode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'website' => 'required|string|max:255',
        ]);

        // Update the vendor record
        $vendor->update([
            'kode' => $request->kode,
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'website' => $request->website,
        ]);

        return redirect()->route('vendorcompany')->with('success', 'Vendor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorCompany  $vendorIndividu
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        // Mengambil data vendor berdasarkan kode
        $vendor = VendorCompany::where('kode', $kode)->firstOrFail();
    
        // Menghapus vendor
        $vendor->delete();
    
        return redirect()->route('vendorcompany')->with('success', 'Vendor deleted successfully!');
    }
}
