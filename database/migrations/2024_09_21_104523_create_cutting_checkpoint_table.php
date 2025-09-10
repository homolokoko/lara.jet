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
        Schema::create('cutting_checkpoint', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('show_checklist')->default(0);
            $table->integer('show_binaudit')->default(0);
            $table->integer('is_fabric_print')->default(0);
            $table->integer('is_fabric_stripe')->default(0);
            $table->integer('is_fabric_solid')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_checkpoint');
    }
};
