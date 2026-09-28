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
        Schema::create('fbc_measure_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('item_id')->nullable();
            $table->integer('measure_profile_chart_id')->nullable();
            $table->string('actual', 100)->nullable();
            $table->decimal('actual_in_decimal', 5)->nullable();
            $table->string('different', 100)->nullable();
            $table->tinyInteger('is_less')->nullable();
            $table->tinyInteger('is_tally')->nullable();
            $table->tinyInteger('is_more')->nullable();
            $table->tinyInteger('is_accept')->nullable();
            $table->tinyInteger('is_valid')->nullable();
            $table->integer('measure_tolerance_define_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fbc_measure_chart');
    }
};
