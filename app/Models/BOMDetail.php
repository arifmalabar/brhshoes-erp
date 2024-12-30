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

    public function bom(){
        return $this->belongsTo(Bom::class, 'id');
    }
}
