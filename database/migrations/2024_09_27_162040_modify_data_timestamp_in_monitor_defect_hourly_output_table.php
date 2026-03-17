<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDataTimestampInMonitorDefectHourlyOutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitor_defect_hourly_output', function (Blueprint $table) {
            //
            $table->dateTime('data_timestamp')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitor_defect_hourly_output', function (Blueprint $table) {
            $table->string('data_timestamp')->change();
        });
    }
}
