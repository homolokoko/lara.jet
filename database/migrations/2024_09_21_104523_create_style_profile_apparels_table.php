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
        Schema::create('style_profile_apparels', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('style_profile_id')->index('style_profile_id');
            $table->integer('styles_apparels_id')->nullable()->index('styles_apperals_id');
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
        Schema::dropIfExists('style_profile_apparels');
    }
};
