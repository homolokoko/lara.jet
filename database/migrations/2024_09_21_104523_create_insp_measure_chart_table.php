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
        Schema::create('insp_measure_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_measure_item_id')->nullable();
            $table->integer('measure_profile_chart_id')->nullable();
            $table->string('actual')->nullable();
            $table->decimal('actual_in_decimal', 10, 4)->nullable();
            $table->string('different')->nullable();
            $table->integer('is_less')->nullable()->default(0);
            $table->integer('is_tally')->nullable()->default(0);
            $table->integer('is_more')->nullable()->default(0);
            $table->integer('is_accept')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_measure_chart');
    }
};
