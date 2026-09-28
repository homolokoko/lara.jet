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
        Schema::create('styles_apperals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('styles_id')->index('styles_id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->integer('apperals_id');
            $table->text('editable')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles_apperals');
    }
};
