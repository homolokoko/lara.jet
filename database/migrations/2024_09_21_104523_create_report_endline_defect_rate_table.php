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
        Schema::create('report_endline_defect_rate', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('report_date')->nullable();
            $table->integer('repair_pcs')->nullable();
            $table->integer('inspected_pcs')->nullable();
            $table->double('defect_rate', 7, 3)->nullable();
            $table->integer('is_dayshift')->nullable()->default(1);
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
        Schema::dropIfExists('report_endline_defect_rate');
    }
};
