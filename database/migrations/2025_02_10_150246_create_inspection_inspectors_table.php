<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionInspectorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_inspectors', function (Blueprint $table) {
            $table->id();
            $table->integer('inspector_id');
            $table->integer('header_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_inspectors');
    }
}
