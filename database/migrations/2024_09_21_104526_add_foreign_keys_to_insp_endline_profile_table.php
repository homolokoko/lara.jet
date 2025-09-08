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
        Schema::table('insp_endline_profile', function (Blueprint $table) {
            $table->foreign(['workstation_locates_id'], 'insp_endline_profile_ibfk_1')->references(['id'])->on('workstation_locates');
            $table->foreign(['purchase_order_id'], 'insp_endline_profile_ibfk_3')->references(['id'])->on('purchase_orders');
            $table->foreign(['style_profile_id'], 'insp_endline_profile_ibfk_2')->references(['id'])->on('style_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insp_endline_profile', function (Blueprint $table) {
            $table->dropForeign('insp_endline_profile_ibfk_1');
            $table->dropForeign('insp_endline_profile_ibfk_3');
            $table->dropForeign('insp_endline_profile_ibfk_2');
        });
    }
};
