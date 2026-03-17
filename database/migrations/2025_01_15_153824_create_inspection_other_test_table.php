<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionOtherTestTable extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_other_test', function (Blueprint $table) {
            $table->id();
            $table->integer('header_id');
            $table->integer('other_test_with_photo_titles_id');
            $table->string('value');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_other_test');
    }
}
