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
        Schema::create('insp_inline_defect', function (Blueprint $table) {
            $table->integer('insp_inline_item_id');
            $table->unsignedInteger('defects_id')->index('defects_id');
            $table->integer('check_points_id');
            $table->string('image')->nullable();
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->integer('style_profile_apperal_id')->nullable()->index('style_profile_apperal_id');
            $table->timestamps();
            $table->integer('job_seqs_id')->nullable()->default(1)->index('job_seqs_id');
            $table->integer('defect_category_id')->nullable()->index('defect_category_id');
            $table->unsignedInteger('defect_cause_id')->nullable()->default(1)->index('defect_cause_id');
            $table->integer('id', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insp_inline_defect');
    }
};
