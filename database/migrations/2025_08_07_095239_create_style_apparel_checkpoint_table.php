<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleApparelCheckpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_apparel_checkpoint', function (Blueprint $table) {
            $table->id();
            $table->integer('style_apperal_id');
            $table->integer('check_point_id');
            $table->timestamps();
            $table->string('number');
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
        Schema::dropIfExists('style_apparel_checkpoint');
    }
}
