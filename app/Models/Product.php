<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'nama_produk',
        'harga_modal',
        'harga_jual',
        'internal_reference',
    ];
}
