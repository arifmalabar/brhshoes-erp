<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPurchaseorderAddrfqsid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->char("rfqs_id", 100)->after("kode");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->dropColumn("rfqs_id");
        });
    }
}
