<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $table = 'components';
    protected $primaryKey = 'id';
    public $incrementing = true; // Menunjukkan bahwa primary key otomatis bertambah
    protected $keyType = 'int'; // Laravel menangani BIGINT sebagai INT dalam casting
    public $timestamps = false; // Nonaktifkan timestamp otomatis

    protected $fillable = [
        'nama',
        'kuantitas',
        'harga_modal',
        'jenis_bahan',
    ];

    // Jangan menambahkan bigint di $casts
}

