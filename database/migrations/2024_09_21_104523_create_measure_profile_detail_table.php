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
        Schema::create('measure_profile_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('measure_profile_header_id')->nullable()->index('measure_profile_header_id');
            $table->string('pom_code')->nullable();
            $table->string('pom_desc')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('measure_profile_detail');
    }
};
