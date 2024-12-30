<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_kategori' => 'Sepatu sekolah'],
            ['nama_kategori' => 'Sepatu pantofel'],
            ['nama_kategori' => 'Sepatu kets'],
        ];
        DB::table('categories')->insert($data);
    }
}
