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
        Schema::table('endline_measure_repair_chart', function (Blueprint $table) {
            $table->foreign(['endline_measure_chart_id'], 'endline_measure_repair_chart_ibfk_1')->references(['id'])->on('endline_measure_chart');
            $table->foreign(['header_id'], 'endline_measure_repair_chart_ibfk_2')->references(['id'])->on('endline_measure_repair_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endline_measure_repair_chart', function (Blueprint $table) {
            $table->dropForeign('endline_measure_repair_chart_ibfk_1');
            $table->dropForeign('endline_measure_repair_chart_ibfk_2');
        });
    }
};
