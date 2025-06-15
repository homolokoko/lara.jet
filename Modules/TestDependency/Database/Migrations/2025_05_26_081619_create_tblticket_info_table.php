<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblticketInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblticket_info', function (Blueprint $table) {
            $table->integer('tblID')->nullable();
            $table->integer('tktd_id')->nullable();
            $table->string('ticketID')->nullable();
            $table->string('orderno')->nullable();
            $table->integer('spID')->nullable();
            $table->string('buyerpo')->nullable();
            $table->integer('garmentID')->nullable();
            $table->string('styleno')->nullable();
            $table->integer('colorID')->nullable();
            $table->string('colorname')->nullable();
            $table->string('size_name')->nullable();
            $table->integer('wpdID')->nullable();
            $table->integer('statusID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblticket_info');
    }
}
