<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorIndividu extends Model
{
    use HasFactory;

    protected $table = 'vendor_individu';  // Pastikan ini menggunakan 'vendor_individu', bukan 'vendor_individus'

    protected $primaryKey = 'kode';  // Menentukan bahwa 'kode' adalah primary key
    public $incrementing = false;    // Menonaktifkan autoincrement karena 'kode' bukan tipe integer auto-increment
    protected $keyType = 'string';   // Menentukan bahwa tipe kolom 'kode' adalah string

    protected $fillable = [
        'kode',
        'name',
        'email',
        'no_telp',
        'alamat',
    ];
    public static function getKode()
    {
        $last = self::orderBy("kode", "DESC")->first();
        $new = "";
        if(self::count() != 0)
        {
            $number = (int) substr($last->kode, 3);
            $increment = $number+1;
            $new = "VI".str_pad($increment, 3, '0', STR_PAD_LEFT);
            //$new = $increment;
        } else {
            $new = "VI001";
        }
        return $new;

    }
}
