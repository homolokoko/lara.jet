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
        Schema::create('endline_measure_defect_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('locate_id');
            $table->integer('defect_found')->default(0);
            $table->date('report_date');
            $table->integer('inspector_id');
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
        Schema::dropIfExists('endline_measure_defect_header');
    }
};
