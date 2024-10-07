<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component', function (Blueprint $table) {
            $table->bigIncrements('component_id');
            $table->string("nama");
            $table->integer("kuantitas")->unsigned();
            $table->integer("harga_modal")->unsigned();
            $table->string("jenis_bahan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component');
    }
}
