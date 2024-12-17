<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_company', function (Blueprint $table) {
            $table->string("kode")->primary();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("no_telp");
            $table->text("alamat");
            $table->string("website");
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
        Schema::dropIfExists('vendor_company');
    }
}
