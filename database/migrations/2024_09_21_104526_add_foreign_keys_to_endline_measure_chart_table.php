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
        Schema::table('endline_measure_chart', function (Blueprint $table) {
            $table->foreign(['inspection_measure_item_id'], 'endline_measure_chart_ibfk_1')->references(['id'])->on('endline_measure_item')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['measure_tolerance_define_id'], 'endline_measure_chart_ibfk_3')->references(['id'])->on('measure_tolerance_define')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['measure_profile_chart_id'], 'endline_measure_chart_ibfk_2')->references(['id'])->on('measure_profile_chart')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endline_measure_chart', function (Blueprint $table) {
            $table->dropForeign('endline_measure_chart_ibfk_1');
            $table->dropForeign('endline_measure_chart_ibfk_3');
            $table->dropForeign('endline_measure_chart_ibfk_2');
        });
    }
};
