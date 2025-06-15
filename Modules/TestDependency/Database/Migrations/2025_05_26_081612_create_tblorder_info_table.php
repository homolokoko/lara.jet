<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblorderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblorder_info', function (Blueprint $table) {
            $table->integer('tblID')->nullable();
            $table->string('orderno')->nullable();
            $table->integer('garmentID')->nullable();
            $table->string('styleno')->nullable();
            $table->string('producttype')->nullable();
            $table->integer('spID')->nullable();
            $table->string('buyerpo')->nullable();
            $table->date('shipdate')->nullable();
            $table->integer('colorID')->nullable();
            $table->string('colorname')->nullable();
            $table->string('size_name')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('statusID_qms')->nullable();
            $table->integer('statusID_order')->nullable();
            $table->string('flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblorder_info');
    }
}
