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
        Schema::create('endline_measure_defect_record', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id');
            $table->integer('defect_id');
            $table->integer('cause_id')->nullable();
            $table->integer('checkpoint_id');
            $table->integer('color_id');
            $table->integer('size_id');
            $table->integer('count')->default(0);
            $table->integer('style_profile_apparel')->comment('reference style profile ');
            $table->integer('style_apparel_id')->comment('apparel with style');
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
        Schema::dropIfExists('endline_measure_defect_record');
    }
};
