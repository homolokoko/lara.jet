<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleSizesTable extends Migration
{
    public function up(): void
    {
        Schema::create('style_sizes', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->integer('size_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_sizes');
    }
}
