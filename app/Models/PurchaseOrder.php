<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\VendorCompany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode',
        'tanggal_pesan',
        'vendor',
        'total',
        'status',
        'tanggal_diterima'
    ];
    public function vendor(){
        return $this->belongsTo(VendorCompany::class, 'vendor_id', 'id');
    }

    // Relasi ke VendorCompany
    public function vendorCompany()
    {
        return $this->belongsTo(VendorCompany::class, 'vendor_id');
    }

    // Relasi ke VendorIndividu
    public function vendorIndividu()
    {
        return $this->belongsTo(VendorIndividu::class, 'vendor_id');
    }
}
