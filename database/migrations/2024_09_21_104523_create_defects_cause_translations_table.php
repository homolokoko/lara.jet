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
        Schema::create('defects_cause_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('cause_id');
            $table->string('name', 100);
            $table->string('locale');
            $table->timestamps();
            $table->integer('id', true);

            $table->unique(['cause_id', 'locale'], 'factory_translations_factory_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defects_cause_translations');
    }
};
