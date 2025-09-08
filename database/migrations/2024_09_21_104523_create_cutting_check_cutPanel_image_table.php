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
        Schema::create('cutting_check_cutPanel_image', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_check_cutPanel_id');
            $table->string('image')->nullable();
            $table->string('stack_position')->nullable();
            $table->integer('is_wrong')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_check_cutPanel_image');
    }
};
