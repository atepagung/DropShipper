<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorWoocomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_woocom', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('wc_cat_id');
            $table->unsignedInteger('store_id');
            $table->timestamps();

            $table->primary(['wc_cat_id', 'store_id']);
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_woocom');
    }
}
