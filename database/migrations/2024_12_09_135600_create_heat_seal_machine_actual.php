<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeatSealMachineActual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heat_seal_machine_actual', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->string('pressure');
            $table->string('temperature');
            $table->integer('heat_seal_machine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heat_seal_machine_actual');
    }
}
