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
        Schema::create('action_taken_endline_measure_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('repair_id')->nullable()->index('repair_id');
            $table->integer('is_lock')->nullable()->default(1);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->integer('last_commenter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_taken_endline_measure_header');
    }
};
