<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHumidityRootTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('humidity_root', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('time_period_id')->nullable();
            $table->integer('fabric_content_id')->nullable();
            $table->double('humidity')->nullable();
            $table->double('temperature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('humidity_root');
    }
}
