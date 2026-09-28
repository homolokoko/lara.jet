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
        Schema::create('report_endline_line_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('locate_id')->nullable();
            $table->integer('defect_id')->nullable();
            $table->integer('defect_found')->nullable();
            $table->integer('is_dayshift')->nullable();
            $table->integer('total_defect')->nullable()->comment('Total Defect Found Within That Locate');
            $table->decimal('rate_in_line', 10)->nullable();
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
        Schema::dropIfExists('report_endline_line_defect');
    }
};
