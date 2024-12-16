<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingOrderDetail extends Model
{
    protected $primaryKey = "manufacturingorderdetails_id";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'manufacturingorders_id',
        'billofmaterialdetails_id',
        'needed',
        'served',
        'used'
        // Add other fillable attributes as needed
    ];
    use HasFactory;

    public static function getKodeMoDetails()
    {
        $last = self::latest("manufacturingorderdetails_id")->first();
        $newcode = "";
        if($last->count() == 0)
        {
            $newcode = "MODS001";
        } else {

        }
    }

}
