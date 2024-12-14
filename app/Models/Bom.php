<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    protected $table = 'billofmaterials';
    protected $primarykey = 'id';
    use HasFactory;
    public static function getId(){
        $newcode = "";
        $lastcode = self::latest("id")->first();
        if(self::count() == 0) {
            $newcode = "B001";
        }else {
            $number = intval(substr($lastcode->id, 1)) + 1;
            $newcode = "M" . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
    }
}
