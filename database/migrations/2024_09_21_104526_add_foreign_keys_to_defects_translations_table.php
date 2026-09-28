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
        Schema::table('defects_translations', function (Blueprint $table) {
            $table->foreign(['defects_id'], 'defects_translations_ibfk_1')->references(['id'])->on('defects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defects_translations', function (Blueprint $table) {
            $table->dropForeign('defects_translations_ibfk_1');
        });
    }
};
