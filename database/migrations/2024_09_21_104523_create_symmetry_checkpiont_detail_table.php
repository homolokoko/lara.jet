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
        Schema::create('symmetry_checkpiont_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('symmetry_checkpoint_id')->nullable();
            $table->integer('measurement_detail_id')->nullable();
            $table->integer('measurement_chart_id')->nullable();
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
        Schema::dropIfExists('symmetry_checkpiont_detail');
    }
};
