<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionPhotographTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_photograph_template', function (Blueprint $table) {
            $table->id();
            $table->integer('title_id');
            $table->text('img');
            $table->text('description')->nullable();
            $table->integer('sort');
            $table->boolean('rotate');
            $table->integer('colspan');
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
        Schema::dropIfExists('inspection_photograph_template');
    }
}
