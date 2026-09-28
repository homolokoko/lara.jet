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
        Schema::create('notice_board_workstation', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('notice_board')->nullable()->index('notice_board_id');
            $table->integer('workstation_id')->nullable()->index('workstation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_board_workstation');
    }
};
