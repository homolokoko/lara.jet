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
        Schema::table('endline_measure_header', function (Blueprint $table) {
            $table->foreign(['locate_id'], 'endline_measure_header_ibfk_4')->references(['id'])->on('workstation_locates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['style_id'], 'endline_measure_header_ibfk_1')->references(['id'])->on('styles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['inspector_id'], 'endline_measure_header_ibfk_3')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['measure_profile_header_id'], 'endline_measure_header_ibfk_2')->references(['id'])->on('measure_profile_header')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endline_measure_header', function (Blueprint $table) {
            $table->dropForeign('endline_measure_header_ibfk_4');
            $table->dropForeign('endline_measure_header_ibfk_1');
            $table->dropForeign('endline_measure_header_ibfk_3');
            $table->dropForeign('endline_measure_header_ibfk_2');
        });
    }
};
