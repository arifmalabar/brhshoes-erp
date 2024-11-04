<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function perusahaan()
    {
        return view("vendor.company", ["nama" => "vendor"]);
    }
    public function individu()
    {
        return view("vendor.individu", ["nama" => "vendor"]);
    }
}
