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
        Schema::create('cutting_checklist_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cutting_header_id')->nullable();
            $table->integer('defect_id')->nullable();
            $table->integer('defects_cause_id')->nullable()->default(0);
            $table->integer('is_correct')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cutting_checklist_defect');
    }
};
