<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterModetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manufacturing_order_details', function (Blueprint $table) {
            //$table->char("manufacturingorders_id", 100)->after("manufacturingorderdetails_id");
            //$table->dropColumn("manufacturingorderdetails_id ");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manufacturing_order_details', function (Blueprint $table) {
            //
        });
    }
}
