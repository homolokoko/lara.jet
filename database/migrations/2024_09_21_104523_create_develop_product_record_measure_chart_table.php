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
        Schema::create('develop_product_record_measure_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('item_id')->nullable()->index('header_id');
            $table->integer('measure_profile_chart_id')->nullable()->index('checkpoint_id');
            $table->string('actual', 100)->nullable();
            $table->string('actual_in_decimal', 100)->nullable();
            $table->string('different', 100)->nullable();
            $table->integer('measure_tolerance_define_id');
            $table->boolean('is_less')->nullable()->default(false)->index('is_less');
            $table->boolean('is_tally')->nullable()->default(true)->index('is_tally');
            $table->boolean('is_more')->nullable()->default(false)->index('is_more');
            $table->boolean('is_accept')->nullable()->default(true)->index('is_accept');
            $table->boolean('is_valid')->default(false);
            $table->integer('is_skip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('develop_product_record_measure_chart');
    }
};
