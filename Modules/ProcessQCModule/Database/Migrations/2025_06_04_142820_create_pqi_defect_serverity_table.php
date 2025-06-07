<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqiDefectServerityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqi_defect_serverity', function (Blueprint $table) {
            $table->id();
            $table->integer('pqi_defect_id')->nullable();
            $table->integer('type')->nullable();
            $table->boolean('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pqi_defect_serverity');
    }
}
