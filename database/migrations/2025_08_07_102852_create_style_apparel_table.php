<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleApparelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_apparel', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->string('name');
            $table->text('image');
            $table->timestamps();
            $table->integer('apparel_id');
            $table->string('editable')->nullable();
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
        Schema::dropIfExists('style_apparel');
    }
}
