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
    public static function getKodeRFQ()
    {
        $newcode= "";
        $last = self::latest("id")->first();
        if(self::count() != 0)
        {
            $number = intval(substr($last->id, 1)) + 1;
            $newcode= "R".str_pad($number, 3, '0', STR_PAD_LEFT);
            return $newcode;
        } else {
            $newcode = "R001";
            return $newcode;
        }
    }
}