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
        Schema::table('styles_apperals', function (Blueprint $table) {
            $table->foreign(['styles_id'], 'styles_apperals_ibfk_1')->references(['id'])->on('styles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('styles_apperals', function (Blueprint $table) {
            $table->dropForeign('styles_apperals_ibfk_1');
        });
    }
};
