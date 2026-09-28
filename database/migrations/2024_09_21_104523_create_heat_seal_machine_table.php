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
        Schema::create('heat_seal_machine', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('style_id')->nullable();
            $table->integer('serial_number_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('line_id')->nullable();
            $table->integer('timing_id')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('pressure')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('officer_id')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('heat_seal_machine');
    }
};
