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
        Schema::create('measure_profile_header', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('styles_id')->nullable()->index('styles_id');
            $table->integer('product_name_id')->nullable();
            $table->integer('product_desc_id')->nullable();
            $table->integer('product_category_id')->nullable();
            $table->integer('version_id')->nullable()->index('version_id');
            $table->integer('unit_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('file_ver')->nullable()->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measure_profile_header');
    }
};
