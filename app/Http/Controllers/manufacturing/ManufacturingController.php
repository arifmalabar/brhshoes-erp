<?php

namespace App\Http\Controllers\manufacturing;

use App\Http\Controllers\Controller;
use App\Models\Manufacturing;
use Illuminate\Http\Request;

class ManufacturingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("manufacturing/manufacturing", ["nama"=> "manufacturing"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("manufacturing/tambah", ["nama"=> "manufacturing"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProduk(Request $request)
    {
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturing $manufacturing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturing $manufacturing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturing $manufacturing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturing  $manufacturing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturing $manufacturing)
    {
        //
    }
}
