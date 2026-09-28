<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_detail', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('course_id');
            $table->integer('staff_id');
            $table->char('class_room')->max(3);
            $table->boolean('status');
            $table->integer('kh_lvl')->nullable();
            $table->integer('en_lvl')->nullable();
            $table->double('monthly_payment')->default(0);
            $table->date('enroll_date')->nullable();
            $table->year('start_course')->nullable();
            $table->year('finish_course')->nullable();
            $table->time('start_session')->nullable();
            $table->time('finish_session')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_detail');
    }
}
