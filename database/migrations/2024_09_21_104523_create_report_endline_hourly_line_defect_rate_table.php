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
        Schema::create('report_endline_hourly_line_defect_rate', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('locate_id')->nullable();
            $table->integer('inspected_qty')->nullable();
            $table->integer('repair_qty')->nullable();
            $table->decimal('defect_rate', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('is_dayshift')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_endline_hourly_line_defect_rate');
    }
};
