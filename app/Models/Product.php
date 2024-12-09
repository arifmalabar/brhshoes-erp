<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;
    public static function getProduct()
    {
        try {
            return Product::get();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
