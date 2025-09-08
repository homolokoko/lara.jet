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
        Schema::table('style_profile_apparels', function (Blueprint $table) {
            $table->foreign(['style_profile_id'], 'style_profile_apparels_ibfk_1')->references(['id'])->on('style_profile');
            $table->foreign(['styles_apparels_id'], 'style_profile_apparels_ibfk_2')->references(['id'])->on('styles_apperals')->onUpdate('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('style_profile_apparels', function (Blueprint $table) {
            $table->dropForeign('style_profile_apparels_ibfk_1');
            $table->dropForeign('style_profile_apparels_ibfk_2');
        });
    }
};
