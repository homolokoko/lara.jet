<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionManualMeasurementsDetailTable extends Migration
{
    public function up(): void
    {
        Schema::create('inspection_manual_measurements_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('header_id');
            $table->integer('manual_measurement_id');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspection_manual_measurements');
    }
}
