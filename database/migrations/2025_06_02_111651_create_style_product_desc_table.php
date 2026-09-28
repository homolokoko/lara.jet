<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStyleProductDescTable extends Migration
{
    public function up(): void
    {
        Schema::create('style_product_desc', function (Blueprint $table) {
            $table->id();
            $table->integer('style_id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('style_product_desc');
    }
}
