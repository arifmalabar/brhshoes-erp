<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['bahan' => 'Kanvas', 'kuantitas' => '50 cm', 'produk_cost' => 30000],
            ['bahan' => 'Sol Karet', 'kuantitas' => '2 Pcs', 'produk_cost' => 15000],
            ['bahan' => 'Insole', 'kuantitas' => '30 cm', 'produk_cost' => 10000],
            ['bahan' => 'Benang Jahit', 'kuantitas' => '100 gram', 'produk_cost' => 8000],
            ['bahan' => 'Lem Sepatu', 'kuantitas' => '200 ml', 'produk_cost' => 10000],
            ['bahan' => 'Tali Sepatu', 'kuantitas' => '2 Pasang (100 cm)', 'produk_cost' => 5000],
            ['bahan' => 'Prexson', 'kuantitas' => '30 cm', 'produk_cost' => 15000],
            ['bahan' => 'Eyelet', 'kuantitas' => '12 buah', 'produk_cost' => 12000],
            ['bahan' => 'Busa / Foam', 'kuantitas' => '50 cm', 'produk_cost' => 25000],
            ['bahan' => 'Furing', 'kuantitas' => '50 cm', 'produk_cost' => 10000],
        ];

        DB::table('data_bahan')->insert($data);
    }
}