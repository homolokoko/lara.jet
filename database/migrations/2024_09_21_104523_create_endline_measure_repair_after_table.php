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
        Schema::create('endline_measure_repair_after', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('repair_header_id')->nullable();
            $table->integer('measure_profile_chart_id')->nullable();
            $table->string('actual', 100)->nullable();
            $table->string('actual_in_decimal', 100)->nullable();
            $table->string('different', 100)->nullable();
            $table->boolean('is_less')->nullable()->default(false);
            $table->boolean('is_tally')->nullable()->default(true);
            $table->boolean('is_more')->nullable()->default(false);
            $table->boolean('is_accept')->nullable()->default(true);
            $table->boolean('is_valid')->nullable()->default(false);
            $table->integer('measure_tolerance_define_id')->nullable()->index('measure_tolerance_define_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endline_measure_repair_after');
    }
};
