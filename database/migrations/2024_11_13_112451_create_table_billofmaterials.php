<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBillofmaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billofmaterials', function (Blueprint $table) {
            $table->char('id', 20)->primary();
            $table->bigInteger('products_id')->unsigned();
            $table->bigInteger("categories_id")->unsigned();
            $table->float("quantity");
            $table->char("satuan", 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_billofmaterials');
    }
}
