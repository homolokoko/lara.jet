<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionInspectorTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_inspector_template', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('photograph_title_id')->nullable();
            $table->integer('sort');
            $table->integer('colspan');
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
        Schema::dropIfExists('inspection_inspector_template');
    }
}
