<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingOrder extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'billofmaterials_id',
        'id',
        'quantity',
        'schedule',
        'late',
        'products_id'
        // Add other fillable attributes as needed
    ];
    protected $primaryKey = 'id';
    use HasFactory;
    public static function getId()
    {
        $newcode = "";
        $lastcode = self::latest("id")->first();
        if(self::count() == 0) {
            $newcode = "M001";
        } else {
            $number = intval(substr($lastcode->id, 1)) + 1;
            $newcode = "M" . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $newcode;
        
        
    }
}
