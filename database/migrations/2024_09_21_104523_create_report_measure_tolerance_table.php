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
        Schema::create('report_measure_tolerance', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->integer('measure_profile_detail_id')->nullable()->comment(' Checkpoint Name');
            $table->integer('measure_profile_id')->nullable()->comment('Related Table Measure_profile_header');
            $table->integer('inspection_id')->nullable();
            $table->integer('tolerance_id')->nullable();
            $table->integer('count')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_measure_tolerance');
    }
};
