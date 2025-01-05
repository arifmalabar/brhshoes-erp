<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCompany extends Model
{
    use HasFactory;
    protected $table = 'vendor_company';  
    protected $primaryKey = 'kode';  
    public $incrementing = false;    
    protected $keyType = 'string';   

    protected $fillable = [
        'kode',
        'name',
        'email',
        'no_telp',
        'alamat',
        'website',
    ];
    public static function getKode()
    {
        $last = self::orderBy("kode", "DESC")->first();
        $new = "";
        if (self::count() != 0) {
            $number = (int) substr($last->kode, 3);
            $increment = $number + 1;
            $new = "VC".str_pad($increment, 3, '0', STR_PAD_LEFT);
        } else {
            $new = "VC001";
        }
        return $new;
    }
}
