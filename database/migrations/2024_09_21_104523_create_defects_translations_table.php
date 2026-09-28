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
        Schema::create('defects_translations', function (Blueprint $table) {
            $table->unsignedInteger('defects_id')->index('defects_id');
            $table->string('name', 100);
            $table->string('locale', 2);
            $table->timestamps();
            $table->integer('id', true)->index('id');

            $table->unique(['defects_id', 'locale'], 'factory_translations_factory_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defects_translations');
    }
};
