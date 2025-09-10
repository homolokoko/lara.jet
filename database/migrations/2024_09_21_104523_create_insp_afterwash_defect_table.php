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
        Schema::create('insp_afterwash_defect', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->integer('insp_item_id');
            $table->unsignedInteger('defects_id')->index('defects_id');
            $table->integer('check_points_id')->index('check_points_id');
            $table->string('image')->nullable();
            $table->integer('style_profile_id')->nullable()->index('style_profile_id');
            $table->integer('style_profile_apperal_id')->nullable();
            $table->integer('defect_category_id')->nullable();
            $table->integer('defect_cause_id')->nullable();
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
        Schema::dropIfExists('insp_afterwash_defect');
    }
};
