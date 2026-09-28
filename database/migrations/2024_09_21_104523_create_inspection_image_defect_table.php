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
        Schema::create('inspection_image_defect', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('inspection_id')->nullable()->index();
            $table->integer('section_id')->nullable()->index();
            $table->string('image_uid')->nullable()->index();
            $table->string('image')->nullable();
            $table->boolean('is_critical')->nullable()->default(false);
            $table->boolean('is_major')->nullable()->default(false);
            $table->boolean('is_minor')->nullable()->default(false);
            $table->integer('defects_id')->nullable()->index();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('sort')->nullable()->default(1);
            $table->integer('color_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_image_defect');
    }
};
