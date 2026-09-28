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
        Schema::create('endline_measure_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable()->index('header_id');
            $table->integer('color_id')->nullable()->index('color_id');
            $table->integer('size_id')->nullable()->index('size_id');
            $table->integer('total_checkpoint_checked')->nullable()->comment('count the row from measure chart');
            $table->integer('total_checkpoint_less')->nullable()->default(0);
            $table->integer('total_checkpoint_tally')->nullable()->default(0);
            $table->integer('total_checkpoint_more')->nullable()->default(0);
            $table->integer('total_check_acceptable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endline_measure_item');
    }
};
