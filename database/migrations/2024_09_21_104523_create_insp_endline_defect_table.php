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
        Schema::create('insp_endline_defect', function (Blueprint $table) {
            $table->integer('insp_measure_endline_item_id')->index('insp_defect_idx_insp_id');
            $table->integer('defects_id')->index('defects_id');
            $table->integer('check_points_id')->index('check_points_id');
            $table->string('image')->nullable();
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->integer('style_profile_apperal_id')->nullable();
            $table->timestamps();
            $table->integer('defect_category_id')->nullable();
            $table->integer('defect_cause_id')->nullable();
            $table->integer('id', true)->index('id');
            $table->integer('operator_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_endline_defect');
    }
};
