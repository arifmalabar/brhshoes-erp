<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBahan extends Model
{
    use HasFactory;
    protected $table = 'data_bahan';
    public $timestamps = false;
    protected $fillable = [
        'bahan',
        'kuantitas',
        'produk_cost',
    ];
}