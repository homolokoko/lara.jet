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
        Schema::create('fbc_measure_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('header_id')->nullable();
            $table->integer('color')->nullable();
            $table->integer('size')->nullable();
            $table->integer('is_pass')->nullable();
            $table->integer('inspector')->nullable();
            $table->timestamps();

            $table->index(['header_id', 'color', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fbc_measure_items');
    }
};
