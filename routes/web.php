<?php

use App\Models\Penghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pembayaran\Bayar;
use App\Http\Controllers\bom\BomController;
use App\Http\Controllers\rfq\RfqController;
use App\Http\Controllers\bahan\BahanController;
use App\Http\Controllers\customer\customerController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\gedung\GedungController;
use App\Http\Controllers\produk\ProdukController;
use App\Http\Controllers\vendor\VendorController;
use App\Http\Controllers\ruangan\RuanganController;
use App\Http\Controllers\tagihan\TagihanController;
use App\Http\Controllers\penghuni\PenghuniController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\grafik_penghuni\GrafikPenghuni;
use App\Http\Controllers\pembayaran\PembayaranController;
use App\Http\Controllers\grafik_pendapatan\GrafikPendapatan;
use App\Http\Controllers\manufacturing\ManufacturingController;
use App\Http\Controllers\manufacturing_order\ManufacturingOrderController;
use App\Http\Controllers\customer\CustomerContoller;


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

Route::controller(ProdukController::class)->group(function () {
    Route::get("/produk", 'index')->name('produk');
    Route::get("/produk/tambah", "create")->name("produk");
    Route::post("/produk/tambah_data", "storeProduk")->name("produk");
    Route::put("/produk/update/{id}", "update");
});




Route::controller(ProdukController::class)->group(function () {
    Route::get("/produk", 'index')->name('produk');
    Route::get("/produk/get_produk", 'getProductData')->name("produk");
    Route::get("/get_kategori", "getKategori")->name("produk");
    Route::get("/produk/tambah_produk", 'create')->name('produk');
    Route::get("/produk/update_produk/{id}", "edit")->name("produk");
    Route::get("/produk/show/{id}", "show")->name("produk");
    Route::post("/produk/tambah_data", 'store')->name("produk");
    Route::delete("/produk/hapus_data/{id}", "destroy")->name("produk");
});
Route::controller(BomController::class)->group(function (){
    Route::get("/bill_material", 'index')->name('bom');
    Route::get("/bill_material/tambah", 'create')->name('bom');
    Route::get("bill_material/edit/{id}", "edit")->name("bom");
});
Route::controller(ManufacturingOrderController::class)->group(function ()  {
    $mo = "/manufacturing_order";
    Route::get($mo, 'index')->name('manufacturing_order');
    Route::get($mo."/detail/{id}", "show");
    Route::get($mo."/tambah", "create")->name('manufacturing_order');
    Route::get($mo."/mo_detail/{id}", 'edit')->name('manufacturing_order');
    Route::get($mo."/product_data", "getProductData");
    Route::get($mo."/bom_data/{id}", "getBomData");
    Route::get($mo."/detail_bom_data/{id}", "getDetailBom");
    Route::post($mo."/tambah_data", "store");
    Route::get($mo."/step/{id}", "onStep")->name("manufacturing_order");
    Route::get($mo."/detailmo/{id}", "showDetailMo");
});
Route::controller(VendorController::class)->group(function () {
    Route::get("/vendor/perusahaan", 'perusahaan')->name('vendor');
    Route::get("/vendor/perorangan", "individu")->name("vendor");
});
Route::controller(CustomerContoller::class)->group(function() {
    $cust = "/customer";
    Route::get($cust, "index")->name("customer");
    Route::get($cust."/data", "getCustomerData");
    Route::post($cust."/tambah", "store");
    Route::put($cust."/update/{id}", "update");
    Route::delete($cust."/delete/{id}", "destroy");
});


// Route Purchase
Route::controller(RfqController::class)->group(function () {
    Route::get("/purchase/rfq", "index")->name("rfq.index");
    Route::get("/purchase/create", "create")->name("rfq.create");
    Route::post("/purchase/rfq", "store")->name("rfq.store");
    Route::get("/purchase/rfq/{id}/edit", "edit")->name("rfq.edit");
    Route::put("/purchase/rfq/{id}", "update")->name("rfq.update");
    Route::delete("/purchase/rfq/{id}", "destroy")->name("rfq.destroy");
});

/*Route::controller(customerController::class)->group(function () {
    Route::get('/customer/index', 'index')->name('customer.index');
    Route::post('/customer/store', 'store')->name('customer.store');
    Route::get('/customer/{id}/edit', 'edit')->name('customer.edit');
    Route::put('/customer/{id}/update', 'update')->name('customer.update');
    Route::delete('/customer/{id}/delete', 'delete')->name('customer.delete');
});*/



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