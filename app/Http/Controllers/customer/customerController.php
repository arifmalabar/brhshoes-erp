<?php

namespace App\Http\Controllers\customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class customerController extends Controller
{
    public function index()
    {
        $data = array(
            "nama"=>"customer",
            "data"=> Customer::all()
        );
        return view('customer.index', $data);
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $no_tlp = $request->no_tlp;
        $email = $request->email;
        $alamat = $request->alamat;

        $data=[
            'nama' => $nama,
            'no_tlp' => $no_tlp,
            'email' => $email,
            'alamat' => $alamat
        ];

        try {
            $simpan = DB::table('customer')->insert($data);
        } catch (\Throwable $th) {
            return response()->json($th);
        }

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }
    public function edit($id)
    {
        $data = Customer::all();
        return view('customer.edit', $data);
    }

    public function update($id, Request $request)
    {
        $nama = $request->nama;
        $no_tlp = $request->no_tlp;
        $email = $request->email;
        $alamat = $request->alamat;

        $data=[
            'nama' => $nama,
            'no_tlp' => $no_tlp,
            'email' => $email,
            'alamat' => $alamat
        ];
        $update = DB::table('customer')->where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate!']);
        }
    }
    public function delete($id)
    {
        $delete = DB::table('customer')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }
}