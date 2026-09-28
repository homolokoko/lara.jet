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
        Schema::table('measurement_profile_sizes', function (Blueprint $table) {
            $table->foreign(['measurement_profile_id'], 'measurement_profile_sizes_ibfk_1')->references(['id'])->on('measurement_profile')->onDelete('CASCADE');
            $table->foreign(['sizes_id'], 'measurement_profile_sizes_ibfk_2')->references(['id'])->on('sizes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measurement_profile_sizes', function (Blueprint $table) {
            $table->dropForeign('measurement_profile_sizes_ibfk_1');
            $table->dropForeign('measurement_profile_sizes_ibfk_2');
        });
    }
};
