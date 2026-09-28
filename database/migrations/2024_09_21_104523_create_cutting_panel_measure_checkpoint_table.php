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
        Schema::create('cutting_panel_measure_checkpoint', function (Blueprint $table) {
            $table->integer('id', true)->unique('id');
            $table->integer('header_id')->nullable();
            $table->integer('checkpoint_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_panel_measure_checkpoint');
    }
};
