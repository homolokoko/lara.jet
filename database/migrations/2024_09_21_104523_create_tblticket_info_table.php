<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblticket_info', function (Blueprint $table) {
            $table->integer('tblID', true);
            $table->integer('tktd_id');
            $table->string('ticket_no', 50);
            $table->integer('wpdID');
            $table->integer('spID');
            $table->string('buyerpo', 100);
            $table->integer('garmentID');
            $table->string('garment', 100);
            $table->integer('colorID');
            $table->string('color', 100);
            $table->string('size', 10);
            $table->integer('qty');

            $table->index(['wpdID', 'ticket_no'], 'idx_wip');
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
};
