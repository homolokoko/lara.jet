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
        Schema::create('measure_profile_chart', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('sizes_id')->nullable()->index('sizes_id');
            $table->string('tolerance_min')->nullable();
            $table->string('tolerance_max')->nullable();
            $table->string('expected_value')->nullable();
            $table->integer('measure_profile_detail_id')->nullable()->index('measure_profile_detail_id');
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
        Schema::dropIfExists('measure_profile_chart');
    }
};
