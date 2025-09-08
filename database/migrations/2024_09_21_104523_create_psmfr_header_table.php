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
        Schema::create('psmfr_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('buyer_id')->nullable();
            $table->integer('style_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('sizes_id')->nullable();
            $table->integer('measure_profile_id')->nullable();
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
        Schema::dropIfExists('psmfr_header');
    }
};
