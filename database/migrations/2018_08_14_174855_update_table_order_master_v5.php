<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableOrderMasterV5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_master', function (Blueprint $table) {
            $table->unsignedInteger('ongkir')->default(0)->after('total_order');
            $table->string('payment_method')->nullable()->after('ongkir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_master', function (Blueprint $table) {
            //
        });
    }
}
