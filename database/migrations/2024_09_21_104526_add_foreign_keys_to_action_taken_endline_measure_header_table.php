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
        Schema::table('action_taken_endline_measure_header', function (Blueprint $table) {
            $table->foreign(['repair_id'], 'action_taken_endline_measure_header_ibfk_1')->references(['id'])->on('endline_measure_repair_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_taken_endline_measure_header', function (Blueprint $table) {
            $table->dropForeign('action_taken_endline_measure_header_ibfk_1');
        });
    }
};
