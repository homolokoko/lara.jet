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
        Schema::table('endline_measure_repair_after', function (Blueprint $table) {
            $table->foreign(['measure_tolerance_define_id'], 'endline_measure_repair_after_ibfk_3')->references(['id'])->on('measure_tolerance_define');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endline_measure_repair_after', function (Blueprint $table) {
            $table->dropForeign('endline_measure_repair_after_ibfk_3');
        });
    }
};
