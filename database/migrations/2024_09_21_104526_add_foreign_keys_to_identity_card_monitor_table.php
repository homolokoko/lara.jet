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
        Schema::table('identity_card_monitor', function (Blueprint $table) {
            $table->foreign(['identity_card_id'], 'identity_card_monitor_ibfk_1')->references(['id'])->on('identity_card');
            $table->foreign(['locate_to'], 'identity_card_monitor_ibfk_3')->references(['id'])->on('workstation_locates');
            $table->foreign(['locate_from'], 'identity_card_monitor_ibfk_2')->references(['id'])->on('workstation_locates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('identity_card_monitor', function (Blueprint $table) {
            $table->dropForeign('identity_card_monitor_ibfk_1');
            $table->dropForeign('identity_card_monitor_ibfk_3');
            $table->dropForeign('identity_card_monitor_ibfk_2');
        });
    }
};
