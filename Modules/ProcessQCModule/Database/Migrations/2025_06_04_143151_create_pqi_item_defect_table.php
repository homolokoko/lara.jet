<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqiItemDefectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqi_item_defect', function (Blueprint $table) {
            $table->id();
            $table->integer('pqi_item_id')->nullable();
            $table->integer('pqi_defect_id')->nullable();
            $table->text('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pqi_item_defect');
    }
}
