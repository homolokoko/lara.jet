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
        Schema::create('inspection_measure_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inspection_measure_item_id')->nullable();
            $table->integer('measure_profile_chart_id')->nullable();
            $table->string('actual', 100)->nullable();
            $table->string('actual_in_decimal', 100)->nullable();
            $table->string('different', 100)->nullable();
            $table->boolean('is_less')->nullable()->default(false);
            $table->boolean('is_tally')->nullable()->default(true);
            $table->boolean('is_more')->nullable()->default(false);
            $table->boolean('is_accept')->nullable()->default(true);
            $table->boolean('is_valid')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_measure_chart');
    }
};
