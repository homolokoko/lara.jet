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
        Schema::create('measurement_check_points', function (Blueprint $table) {
            $table->integer('measurements_apperals_id')->index('measurements_apperals_id');
            $table->integer('check_points_id')->index('check_points_id');
            $table->integer('sizes_id');
            $table->string('tolerances', 100)->nullable();
            $table->string('spec', 100)->nullable();
            $table->string('id', 10)->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurement_check_points');
    }
};
