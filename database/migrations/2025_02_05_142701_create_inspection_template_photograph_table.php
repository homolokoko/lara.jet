<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionTemplatePhotographTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_template_photograph', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id');
            $table->integer('desc_id');
            $table->integer('sort')->nullable();
            $table->integer('colspan')->nullable();
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
        Schema::dropIfExists('inspection_template_photograph');
    }
}
