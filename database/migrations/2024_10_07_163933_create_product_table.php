<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements("product_id");
            $table->bigInteger("category_id");
            $table->string("nama_produk");
            $table->integer("jumlah")->unsigned();
            $table->integer('harga_modal')->unsigned();
            $table->integer("harga_jual")->unsigned();
            $table->char('internal_reference');
            $table->string("barcode");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
