<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    public $fillable = [
        "nama_produk",
        "harga_modal",
        "harga_jual",
        "internal_reference"
    ];
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
