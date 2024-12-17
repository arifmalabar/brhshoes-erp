<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCompany extends Model
{
    use HasFactory;
    protected $table = 'vendor_company';  
    protected $primaryKey = 'kode';  
    public $incrementing = false;    
    protected $keyType = 'string';   

    protected $fillable = [
        'kode',
        'name',
        'email',
        'no_telp',
        'alamat',
        'website',
    ];
}
