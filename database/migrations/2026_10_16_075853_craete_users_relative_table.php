<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteUsersRelativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_relative',function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id');
            $table->integer('who_they');
            $table->string('name');
            $table->string('career');
            $table->boolean('is_current');
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
        Schema::dropIfExists('users_relative');
    }
}
