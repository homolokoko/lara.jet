<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreBulletSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_bullet_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('score_bullet_header_id')->constrained('score_bullet_header')->cascadeOnDelete();
            $table->string('subject');
            $table->integer('full_marks');
            $table->integer('actual_marks')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_bullet_subjects');
    }
}
