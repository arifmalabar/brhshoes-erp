<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturingorderdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturingorderdetails', function (Blueprint $table) {
            $table->char("manufacturingorderdetails_id")->primary();
            $table->char("billofmaterialdetails_id");
            $table->float("needed");
            $table->float("served");
            $table->float("used");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturingorderdetails');
    }
}
