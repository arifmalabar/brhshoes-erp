<?php

namespace App\Models;

use App\Models\DetailRFQ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RFQ extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'rfqs';

    // Primary key
    protected $primaryKey = 'id';

    // Key bukan integer increment
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'string';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id',
        'vendor_id',
        'tgl_pesan',
    ];

    public function details()
    {
        return $this->hasMany(DetailRFQ::class, 'rfqs_id', 'id');
    }
}