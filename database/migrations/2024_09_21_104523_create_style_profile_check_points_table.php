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
        Schema::create('style_profile_check_points', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('style_profile_apparels_id')->index('measurement_check_points_ibfk_1');
            $table->integer('check_points_id')->index('check_points_id');
            $table->string('number')->nullable()->index('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('style_profile_check_points');
    }
};
