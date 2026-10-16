<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CraeteUsersRelativePhonenumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_relative_phonenumbers',function (Blueprint $table){
            $table->id();
            $table->foreignId('user_relative_id')->constrained('users_relative')->cascadeOnDelete();
            $table->bigInteger('number');
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
        Schema::dropIfExists('users_relative_phonenumbers');
    }
}
