<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('dob');
            $table->integer('room')->nullable();
            $table->integer('shift')->nullable();
            $table->integer('lvl')->nullable();
            $table->integer('edu_lvl')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_female')->nullable();
            $table->boolean('is_married')->nullable();
            $table->longText('other')->nullable();
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
        Schema::dropIfExists('users_detail');
    }
}
