<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleColorTable extends Migration
{
    public function up(): void
    {
        Schema::create('style_colors', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->integer('color_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_color');
    }
}
