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
        Schema::create('report_endline_measure_tol', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('measure_profile_detail')->nullable();
            $table->integer('locate')->nullable();
            $table->integer('version')->nullable();
            $table->integer('tol_1')->nullable()->default(0);
            $table->integer('tol_2')->nullable()->default(0);
            $table->integer('tol_3')->nullable()->default(0);
            $table->integer('tol_4')->nullable()->default(0);
            $table->integer('tol_5')->nullable()->default(0);
            $table->integer('tol_6')->nullable()->default(0);
            $table->integer('tol_7')->nullable()->default(0);
            $table->integer('tol_8')->nullable()->default(0);
            $table->integer('tol_9')->nullable()->default(0);
            $table->integer('tol_10')->nullable()->default(0);
            $table->integer('tol_11')->nullable()->default(0);
            $table->integer('tol_12')->nullable()->default(0);
            $table->integer('tol_13')->nullable()->default(0);
            $table->integer('tol_14')->nullable()->default(0);
            $table->integer('tol_15')->nullable()->default(0);
            $table->integer('tol_16')->nullable()->default(0);
            $table->integer('tol_17')->nullable()->default(0);
            $table->integer('tol_18')->nullable()->default(0);
            $table->integer('tol_19')->nullable()->default(0);
            $table->integer('tol_20')->nullable()->default(0);
            $table->integer('tol_21')->nullable()->default(0);
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
        Schema::dropIfExists('report_endline_measure_tol');
    }
};
