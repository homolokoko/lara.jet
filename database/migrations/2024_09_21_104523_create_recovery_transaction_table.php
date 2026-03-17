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
        Schema::create('recovery_transaction', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->integer('type')->nullable()->comment('1=receive / 2=send / 3=dispose');
            $table->timestamps();
            $table->integer('users_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recovery_transaction');
    }
};
