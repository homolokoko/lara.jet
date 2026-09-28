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
        Schema::create('style_profile_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('style_profile_id')->index('measurement_profile_id');
            $table->integer('sizes_id')->index('measurement_profile_sizes_ibfk_2');
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
        Schema::dropIfExists('style_profile_sizes');
    }
};
