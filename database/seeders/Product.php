<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['category_id' => 1, 'nama_produk' => 'Sepatu Sekolah', 'harga_modal' => 50000, 'harga_jual' => 350000, 'internal_reference' => "SS"],
        ];
        DB::table('products')->insert($data);
    }
}
