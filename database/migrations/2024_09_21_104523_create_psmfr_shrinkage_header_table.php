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
        Schema::create('psmfr_shrinkage_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('buyer_id')->nullable();
            $table->integer('styles_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->double('shrinkage_height', 4, 2)->nullable();
            $table->double('shrinkage_width', 4, 2)->nullable();
            $table->integer('measurement_profile_id')->nullable();
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
        Schema::dropIfExists('psmfr_shrinkage_header');
    }
};
