<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorIndividuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_individu', function (Blueprint $table) {
            $table->string("kode")->primary();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("no_telp");
            $table->text("alamat");
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
        Schema::dropIfExists('vendor_individu');
        
    }
}
