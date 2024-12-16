<?php

namespace App\Models;

use App\Models\RFQ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailRFQ extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'detail_rfqs';

    // Primary key
    protected $primaryKey = 'id';

    // Key bukan integer increment
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'string';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id',
        'rfqs_id',
        'components_id',
        'kuantitas',
        'subtotal',
    ];

    public function rfq()
    {
        return $this->belongsTo(RFQ::class, 'rfqs_id', 'id');
    }
}