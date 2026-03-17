<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffParentCareerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_parent_career', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('dad_name')->nullable();
            $table->string('dad_career')->nullable();
            $table->string('mom_name')->nullable();
            $table->string('mom_career')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_parent_career');
    }
}
