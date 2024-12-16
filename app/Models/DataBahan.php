<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBahan extends Model
{
    use HasFactory;
    protected $table = 'components';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'kuantitas',
        'harga_modal',
    ];
}
