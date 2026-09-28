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
        Schema::table('style_profile_sizes', function (Blueprint $table) {
            $table->foreign(['sizes_id'], 'style_profile_sizes_ibfk_2')->references(['id'])->on('sizes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('style_profile_sizes', function (Blueprint $table) {
            $table->dropForeign('style_profile_sizes_ibfk_2');
        });
    }
};
