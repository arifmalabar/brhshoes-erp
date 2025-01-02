<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_orders')->insert([
            [
                'kode' => 'PO001',
                'tanggal' => '2024-01-01',
                'vendor' => 'Vendor A',
                'produk' => 'Kanvas',
                'deskripsi' => 'Kanvas untuk sepatu',
                'kuantitas' => 10,
                'diterima' => 5,
                'ditagih' => 5,
                'harga_satuan' => 30000,
                'sub_total' => 300000,
            ],
            [
                'kode' => 'PO002',
                'tanggal' => '2024-01-02',
                'vendor' => 'Vendor B',
                'produk' => 'Sol Karet',
                'deskripsi' => 'Sol Karet sepatu',
                'kuantitas' => 8,
                'diterima' => 8,
                'ditagih' => 8,
                'harga_satuan' => 15000,
                'sub_total' => 120000,
            ],
        ]);
        
    }
}
