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
        Schema::table('styles_apperals_check_points', function (Blueprint $table) {
            $table->foreign(['styles_apperals_id'], 'styles_apperals_check_points_ibfk_1')->references(['id'])->on('styles_apperals')->onDelete('CASCADE');
            $table->foreign(['check_points_id'], 'styles_apperals_check_points_ibfk_2')->references(['id'])->on('check_points')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('styles_apperals_check_points', function (Blueprint $table) {
            $table->dropForeign('styles_apperals_check_points_ibfk_1');
            $table->dropForeign('styles_apperals_check_points_ibfk_2');
        });
    }
};
