<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuition_info', function (Blueprint $table) {
            $table->id();
            $table->integer('off')->default(0);
            $table->integer('user_id');
            $table->integer('course_id');
            $table->integer('staff_id');
            $table->integer('student_id');
            $table->string('phonenumber')->nullable();
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
        Schema::dropIfExists('tuition_info');
    }
}
