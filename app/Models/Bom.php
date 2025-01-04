<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
   
    use HasFactory;
    protected $table = 'billofmaterials';
    protected $primarykey = 'id';
    public $incrementing = false;
    protected $fillable = [
        "id",
        "products_id",
        "categories_id",
        "quantity",
        "satuan"
    ];
    public $timestamps = false;
    public static function getId(){
        $last = self::select("id")->orderBy("id", "DESC")->first();
        $length = self::count();
        $new = "";
        if($length == 0){
            $new = "BOM001";
        } else {
            $number = (int) substr($last->id, 3);
            $new = "BOM".str_pad($number+1, 3, '0', STR_PAD_LEFT);
        }
        return $new;
    }
}
