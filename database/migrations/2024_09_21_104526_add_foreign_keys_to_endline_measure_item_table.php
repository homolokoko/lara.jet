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
        Schema::table('endline_measure_item', function (Blueprint $table) {
            $table->foreign(['header_id'], 'endline_measure_item_ibfk_1')->references(['id'])->on('endline_measure_header')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['size_id'], 'endline_measure_item_ibfk_3')->references(['id'])->on('sizes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['color_id'], 'endline_measure_item_ibfk_2')->references(['id'])->on('color')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endline_measure_item', function (Blueprint $table) {
            $table->dropForeign('endline_measure_item_ibfk_1');
            $table->dropForeign('endline_measure_item_ibfk_3');
            $table->dropForeign('endline_measure_item_ibfk_2');
        });
    }
};
