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
        Schema::create('styles_apperals_check_points', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('styles_apperals_id')->nullable()->index('styles_apperals_id');
            $table->integer('check_points_id')->nullable()->index('check_points_id');
            $table->timestamps();
            $table->string('number')->nullable();
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
        Schema::dropIfExists('styles_apperals_check_points');
    }
};
