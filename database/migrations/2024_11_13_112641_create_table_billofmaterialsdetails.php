<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBillofmaterialsdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billofmaterialsdetails', function (Blueprint $table) {
            $table->char("id", 20);
            $table->bigInteger("components_id")->unsigned();
            $table->float("quantity");
            $table->integer("price")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_billofmaterialsdetails');
    }
}
