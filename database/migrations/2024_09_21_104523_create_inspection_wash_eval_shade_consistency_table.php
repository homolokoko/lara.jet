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
        Schema::create('inspection_wash_eval_shade_consistency', function (Blueprint $table) {
            $table->integer('wash_eval_id')->nullable();
            $table->integer('id', true);
            $table->integer('color_id')->nullable();
            $table->integer('outOfShadelighter')->nullable();
            $table->integer('inBandLighter')->nullable();
            $table->integer('mediumTarget')->nullable();
            $table->integer('inBandDarker')->nullable();
            $table->integer('outOfBandDarker')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_wash_eval_shade_consistency');
    }
};
