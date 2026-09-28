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
        Schema::create('measurement_apperals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('measurement_profile_id');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->integer('styles_apperals_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurement_apperals');
    }
};
