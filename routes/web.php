<?php

use App\Http\Controllers\bahan\BahanController;
use App\Http\Controllers\bom\BomController;
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
use App\Http\Controllers\manufacturing_order\ManufacturingOrderController;
use App\Http\Controllers\produk\ProdukController;
use App\Http\Controllers\vendor\VendorController;
use App\Http\Controllers\VendorCompanyController;
use App\Http\Controllers\VendorIndividuController;
use App\Http\Controllers\PurchaseorderController;
use App\Http\Controllers\customer\CustomerContoller;
use App\Http\Controllers\rfq\RfqController;






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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*Route::get('/dashboard', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
})->name('dashboard');*/

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/informasikost', 'informasiKostJson');
});
Route::prefix('bahan')->group(function () {
    Route::get('/', [BahanController::class, 'index'])->name('bahan.index'); // Menampilkan semua bahan
    Route::get('/tambah', [BahanController::class, 'create'])->name('bahan.create'); // Form tambah bahan
    Route::post('/store', [BahanController::class, 'store'])->name('bahan.store'); // Menyimpan bahan
    Route::get('/edit/{id}', [BahanController::class, 'edit'])->name('bahan.edit'); // Form edit bahan
    Route::put('/update/{id}', [BahanController::class, 'update'])->name('bahan.update'); // Memperbarui bahan
    Route::delete('/delete/{id}', [BahanController::class, 'destroy'])->name('bahan.delete'); // Menghapus bahan
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
Route::controller(PurchaseorderController::class)->group(function () {
    Route::get("/purchase/order", "order")->name("purchaseorder");
    Route::post("/purchase/order/create", "store")->name("purchaseorder.store"); 
    Route::post("/purchase/tambah_pesanan", "tambahBahan");
    Route::get("/purchase/validasi{kode}", "validasi")->name("purchasevalidasi");
    Route::post('/update-tanggal-diterima', 'updateTanggalDiterima')->name('updateTanggalDiterima');
    Route::get("/purchase/bayar{kode}", "bayar")->name("purchasebayar");
    Route::get("/purchase/konfirmasi{kode}", "konfirmasi")->name("purchasekonfirmasi");
    Route::get("/purchase/selesai{kode}", "selesai")->name("purchaseselesai");
});
Route::controller(BahanController::class)->group(function () {
    Route::get("/bahan", 'index')->name('bahan');
    
});
Route::controller(BomController::class)->group(function (){
    Route::get("/bill_material", 'index')->name('bom');
    Route::get("/bill_material/tambah", 'create')->name('bom');
    Route::get("bill_material/edit/{id}", "edit")->name("bom");
});
Route::controller(ManufacturingOrderController::class)->group(function ()  {
    Route::get("/manufacturing_order", 'index')->name('manufacturing_order');
    Route::get("/manufacturing_order/mo_detail", 'create')->name('manufacturing_order');
});
Route::controller(VendorCompanyController::class)->group(function () {
    Route::get("/vendor/company", 'company')->name('vendorcompany');
    Route::post("/vendor/company/create", "store")->name("vendorcompany.store"); 
    Route::put("/vendor/company/{kode}/update", "update")->name("vendorcompany.update"); 
    Route::delete("/vendor/company/{kode}/delete", "destroy")->name("vendorcompany.destroy"); 
});
Route::controller(VendorIndividuController::class)->group(function () {
    Route::get("/vendor/perorangan", "individu")->name("vendor");
    Route::post("/vendor/perorangan/create", "store")->name("vendor.store"); 
    Route::put("/vendor/perorangan/{kode}/update", "update")->name("vendor.update"); 
    Route::delete("/vendor/perorangan/{kode}/delete", "destroy")->name("vendor.destroy"); 
});

Route::controller(PurchaseorderController::class)->group(function () {
    Route::get("/purchase/order", "order")->name("purchaseorder");
    Route::post("/purchase/order/create", "store")->name("purchaseorder.store"); 
    Route::post("/purchase/tambah_pesanan", "tambahBahan");
    Route::get("/purchase/validasi{kode}", "validasi")->name("purchasevalidasi");
    Route::post('/update-tanggal-diterima', 'updateTanggalDiterima')->name('updateTanggalDiterima');
    Route::get("/purchase/bayar{kode}", "bayar")->name("purchasebayar");
    Route::get("/purchase/konfirmasi{kode}", "konfirmasi")->name("purchasekonfirmasi");
    Route::get("/purchase/selesai{kode}", "selesai")->name("purchaseselesai");
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

Route::get("/profile", function () {
    return view("profile/profile", ["nama" => "profile"]);
})->name('profile')->middleware('auth');

// Route::get("/penghuni_ruang", function () {
//     return view("penghuni/penghuni", ["nama"=> "penghuni ruang"]);
// });

// Route::get("/pindah_ruang", function () {
//     return view("pindah_ruang/pindahruang", ["nama"=> "pindah ruang"]);
// });

Route::get("/laporan_pendapatan", function () {
    //return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"])->middleware('auth');
    return view("laporan_pendapatan/laporan_pendapatan", ["nama" => "laporan pendapatan"]);
});