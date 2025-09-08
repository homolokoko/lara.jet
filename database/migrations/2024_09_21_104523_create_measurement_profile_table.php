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
        Schema::create('measurement_profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('styles_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('measurement_unit_id');
            $table->integer('version_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('measurement_profile');
    }
};
