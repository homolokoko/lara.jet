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
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->foreign(['insp_endline_profile_id'], 'insp_endline_item_ibfk_1')->references(['id'])->on('insp_endline_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_endline_item', function (Blueprint $table) {
            $table->dropForeign('insp_endline_item_ibfk_1');
        });
    }
};
