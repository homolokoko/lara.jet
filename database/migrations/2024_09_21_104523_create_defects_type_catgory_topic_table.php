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
        Schema::create('defects_type_catgory_topic', function (Blueprint $table) {
            $table->integer('defects_id')->index('defects_type_catgory_topic_ibfk_1');
            $table->integer('defects_type_title_id')->index('defects_type_catgory_topic_ibfk_2');
            $table->integer('defect_category_title_id');
            $table->integer('defects_topic_title_id');
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
        Schema::dropIfExists('defects_type_catgory_topic');
    }
};
