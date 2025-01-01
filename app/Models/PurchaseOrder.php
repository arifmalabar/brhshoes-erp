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
    public static function getKode()
    {
        $last = self::orderBy("kode", "DESC")->first();
        $length = self::count();
        $new = "";
        if($length == 0){
            $new = "P001";
        } else {
            $number = (int) substr($last->kode, 1);
            $new = "P".str_pad($number+1, 3, '0', STR_PAD_LEFT);
        }
        return $new;
    }
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
