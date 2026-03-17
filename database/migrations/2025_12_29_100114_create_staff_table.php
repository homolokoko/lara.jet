<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name_kh')->nullable();
            $table->string('name_en')->nullable();
            $table->string('edu_lvl');
            $table->boolean('is_female')->default(true);
            $table->boolean('is_married')->default(false);
            $table->integer('position_id')->default(0);
            $table->string('level');
            $table->date('dob');
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
        Schema::dropIfExists('staff');
    }
}
