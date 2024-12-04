<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRfqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rfqs', function (Blueprint $table) {
            $table->char("id", 100)->primary();
            $table->char("rfqs_id", 100);
            $table->char("components_id", 100);
            $table->integer("kuantitas")->unsigned();
            $table->integer("subtotal")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_rfqs');
    }
}
