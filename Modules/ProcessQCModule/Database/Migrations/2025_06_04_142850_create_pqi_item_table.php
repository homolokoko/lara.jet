<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqiItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqi_item', function (Blueprint $table) {
            $table->id();
            $table->integer('pqi_header_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('inspector_id')->nullable();
            $table->text('desc')->nullable();
            $table->integer('workstation_locate_id')->nullable();
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
        Schema::dropIfExists('pqi_item');
    }
}
