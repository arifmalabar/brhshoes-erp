<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->char("purchase_order_id", 100);
            $table->char("component_id", 100);
            $table->integer("kuantitas")->unsigned();
            $table->integer("diterima")->unsigned();
            $table->integer("harga_satuan")->unsigned();
            $table->integer("subtotal")->unsigned();
            $table->text("deskripsi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
}
