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
        Schema::create('psmfr_shrinkage_detail', function (Blueprint $table) {
            $table->integer('id', true)->unique('psmfr_shrinkage_detail_pk');
            $table->integer('measure_profile_detail_id')->nullable();
            $table->integer('header_id')->nullable();
            $table->string('shrinkage', 100)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('updated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psmfr_shrinkage_detail');
    }
};
