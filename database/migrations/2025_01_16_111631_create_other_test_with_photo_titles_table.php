<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherTestWithPhotoTitlesTable extends Migration
{
    public function up(): void
    {
        Schema::create('other_test_with_photo_titles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_test_with_photo_titles');
    }
}
