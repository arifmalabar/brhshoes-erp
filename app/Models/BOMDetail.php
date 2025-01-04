<?php

namespace App\Models;

use App\Models\Bom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOMDetail extends Model
{
    use HasFactory;
    protected $table = 'billofmaterialsdetails';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'components_id',
        'quantity',
        'price',
    ];
    public $incrementing = false;
    public static function getId(){
        $last = self::select("id")->orderBy("id", "DESC")->first();
        $length = self::count();
        $new = "";
        if($length == 0){
            $new = "BOD001";
        } else {
            $number = (int) substr($last->id, 3);
            $new = "BOD".str_pad($number+1, 3, '0', STR_PAD_LEFT);
        }
        return $new;
    }
    public function bom(){
        return $this->belongsTo(Bom::class, 'id');
    }
}
