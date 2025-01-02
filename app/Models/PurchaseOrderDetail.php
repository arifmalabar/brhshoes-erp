<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;
    public $timestamps  = false;
    public static function getPoDetail($kode)
    {
        return self::selectRaw("components.nama, purchase_order_details.kuantitas, purchase_order_details.diterima, purchase_order_details.harga_satuan, purchase_order_details.subtotal, purchase_order_details.deskripsi")->where("purchase_order_id", "=", $kode)->join("components", "components.id", "=", "purchase_order_details.component_id")->get();
    }
}
