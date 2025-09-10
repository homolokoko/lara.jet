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
        Schema::create('fusing_machine', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('ia_number')->nullable();
            $table->string('machine_sr_number', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('temperature', 100)->nullable();
            $table->string('pressure', 100)->nullable();
            $table->timestamp('time')->nullable();
            $table->string('machine_condition', 100)->nullable();
            $table->string('belt_condition', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->text('comment')->nullable();
            $table->text('description')->nullable();
            $table->integer('customer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fusing_machine');
    }
};
