<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorDefectHourlyOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_defect_hourly_output', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('order_number')->nullable();
            $table->integer('reject_pcs')->nullable();
            $table->string('sew_line')->nullable();
            $table->string('data_timestamp')->nullable();
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
        Schema::dropIfExists('monitor_defect_hourly_output');
    }
}
