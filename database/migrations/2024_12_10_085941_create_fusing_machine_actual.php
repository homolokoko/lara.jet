<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFusingMachineActual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fusing_machine_actual', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->string('pressure');
            $table->string('temperature');
            $table->integer('fusing_machine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fusing_machine_actual');
    }
}
