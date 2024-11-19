<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturingOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturing_orders', function (Blueprint $table) {
            $table->char("id", 20)->primary();
            $table->char("billofmaterials_id", 20);
            $table->float("quantity");
            $table->date("schedule");
            $table->date("late");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturing_orders');
    }
}
