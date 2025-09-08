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
        Schema::create('inspection_measure_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inspection_measure_header_id')->nullable();
            $table->string('no', 100)->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('total_checkpoint_checked')->nullable()->comment('count the row from measure chart');
            $table->integer('total_checkpoint_less')->nullable()->default(0);
            $table->integer('total_checkpoint_tally')->nullable()->default(0);
            $table->integer('total_checkpoint_more')->nullable()->default(0);
            $table->integer('total_check_acceptable')->nullable();
            $table->timestamps();
            $table->integer('inspection_id')->nullable();
            $table->integer('color_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_measure_item');
    }
};
