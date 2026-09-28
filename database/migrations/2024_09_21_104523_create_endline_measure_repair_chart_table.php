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
        Schema::create('endline_measure_repair_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index('header_id');
            $table->integer('endline_measure_chart_id')->nullable()->index('endline_measure_chart_id');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endline_measure_repair_chart');
    }
};
