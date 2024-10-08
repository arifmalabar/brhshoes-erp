<?php

use App\Http\Controllers\dashboard\DashboardController;
use App\Models\Penghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pembayaran\Bayar;
use App\Http\Controllers\gedung\GedungController;
use App\Http\Controllers\grafik_pendapatan\GrafikPendapatan;
use App\Http\Controllers\grafik_penghuni\GrafikPenghuni;
use App\Http\Controllers\ruangan\RuanganController;
use App\Http\Controllers\penghuni\PenghuniController;
use App\Http\Controllers\pembayaran\PembayaranController;
use App\Http\Controllers\tagihan\TagihanController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\manufacturing\ManufacturingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*Route::get('/dashboard', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
})->name('dashboard');*/

Route::controller(DashboardController::class)->group(function() {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/informasikost', 'informasiKostJson');
});

Route::controller(ManufacturingController::class)->group(function () {
    Route::get("/manufacturing", 'index')->name('manufacturing');
    Route::get("/manufacturing/tambah", "create")->name("manufacturing");
    Route::post("/manufacturing/tambah_data", "storeProduk")->name("manufacturing");
});

// Route::get('/register', function () {
//     return view("register/register", ["nama"=> "register"]);
// });

Route::get("/profile", function(){
    return view("profile/profile", ["nama"=> "profile"]);
})->name('profile')->middleware('auth');

// Route::get("/penghuni_ruang", function () {
//     return view("penghuni/penghuni", ["nama"=> "penghuni ruang"]);
// });

// Route::get("/pindah_ruang", function () {
//     return view("pindah_ruang/pindahruang", ["nama"=> "pindah ruang"]);
// });

Route::get("/laporan_pendapatan", function(){
    //return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"])->middleware('auth');
    return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"]);
});
