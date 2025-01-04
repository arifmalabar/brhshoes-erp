<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\penghuni\PenghuniController;
use App\Http\Controllers\bom\BomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BomController::class)->group(function (){
    Route::get("/bill_material", 'index')->name('bom');
    Route::get("/bill_material/create", 'create')->name('bom.create');
    Route::get("bill_material/edit/{id}", "edit")->name("bom.edit");
    Route::put("bill_material/{id}", "update")->name("bom.update");
    Route::get("/bill_material/show/{id)", "show")->name("bom");
    Route::post("/bill_material/tambah_data", 'store')->name("bom.store");
    Route::delete("/bill_material/hapus_data/{id", "destroy")->name("bom");
});