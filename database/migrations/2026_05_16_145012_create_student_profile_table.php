<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_profile', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_kh')->nullable();
            $table->date('date_of_birth');
            $table->char('gender');
            $table->string('room')->nullable();
            $table->integer('staff_id')->nullable();
            $table->string('shift')->nullable();
            $table->longText('other')->nullable();
            $table->integer('father_id')->nullable();
            $table->integer('mother_id')->nullable();
            $table->integer('birth_address_id')->nullable();
            $table->integer('current_address_id')->nullable();
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
        Schema::dropIfExists('student_profile');
    }
}
