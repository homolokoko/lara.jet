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
        Schema::create('symmetric_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('symmetric_header_id')->nullable();
            $table->integer('symmetric_version_id')->nullable();
            $table->integer('symmetric_group_version_id')->nullable();
            $table->integer('measure_profile_detail_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symmetric_detail');
    }
};
