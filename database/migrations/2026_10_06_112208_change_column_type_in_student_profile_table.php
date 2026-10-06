<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInStudentProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_profile', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
        Schema::table('student_profile', function (Blueprint $table) {
            $table->integer('shift')->change()->nullable();
            $table->boolean('is_female')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_profile', function (Blueprint $table) {
            $table->dropColumn('shift');
            $table->dropColumn('is_female');
        });
    }
}
