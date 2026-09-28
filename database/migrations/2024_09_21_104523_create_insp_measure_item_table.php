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
        Schema::create('insp_measure_item', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('insp_measure_header_id')->nullable();
            $table->string('item_number', 25)->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('total_checked')->nullable()->comment('count the row from measure chart');
            $table->integer('total_less')->nullable()->default(0);
            $table->integer('total_tally')->nullable()->default(0);
            $table->integer('total_more')->nullable()->default(0);
            $table->integer('total_acceptable')->nullable();
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
        Schema::dropIfExists('insp_measure_item');
    }
};
