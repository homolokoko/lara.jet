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
        Schema::create('identity_card', function (Blueprint $table) {
            $table->integer('id', true)->index('id');
            $table->char('uuid', 16)->unique('uuid');
            $table->integer('is_active')->nullable()->default(1);
            $table->integer('is_occupied')->nullable()->default(0);
            $table->timestamps();
            $table->string('image')->nullable();
            $table->integer('is_printed')->nullable()->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_card');
    }
};
