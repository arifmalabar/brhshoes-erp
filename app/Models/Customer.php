<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    public $fillable = [
        "id",
        "NIK",
        "name", 
        "notelp",
        "email",
        "alamat"
    ];
    public static function getKodeCustomer()
    {
        $newcode= "";
        $last = self::latest("id")->first();
        if(self::count() != 0)
        {
            $number = intval(substr($last->id, 1)) + 1;
            $newcode= "C".str_pad($number, 3, '0', STR_PAD_LEFT);
        } else {
            $newcode = "C001";
        }
        return $newcode;
    }
}
